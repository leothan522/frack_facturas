<?php

namespace App\Traits;

use App\Mail\AvisoCorteMail;
use App\Mail\FacturasMail;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Imagen;
use App\Models\Organizacion;
use App\Models\Pago;
use App\Models\Plan;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

trait Facturas
{
    public $facturaNumero, $facturaRowquid;
    public $verPDF;

    protected function createFacturaTrait($servicios_id): bool
    {
        $servicio = Servicio::find($servicios_id);

        if ($servicio) {

            $organizacion = Organizacion::find($servicio->organizaciones_id);
            $imagen = null;
            $mini = null;
            $imagenes = Imagen::where('nombre', 'organizaciones')->where('tabla_id', $organizacion->id)->first();
            if ($imagenes){
                $imagen = $imagenes->imagen;
                $mini = $imagenes->mini;
            }
            $cliente = Cliente::find($servicio->clientes_id);
            $plan = Plan::find($servicio->planes_id);

            $hoy = Carbon::parse(date("Y-m-d"));

            //numero Factura
            $next = 1;
            if (!empty($organizacion->proxima_factura)){
                $next = $organizacion->proxima_factura;
            }
            $formato = $organizacion->formato_factura;
            $i = 0;
            do{
                $next = $next + $i;
                $factura_numero = $formato . cerosIzquierda($next, numSizeCodigo());
                $existe = Factura::where('factura_numero', $factura_numero)->where('organizaciones_id', $organizacion->id)->first();
                if ($existe){ $i++; }
            }while($existe);

            //fecha factura
            $ultima = Factura::where('servicios_id', $servicio->id)->orderBy('factura_fecha', 'DESC')->first();
            if ($ultima) {
                $ultima_fecha = Carbon::parse($ultima->factura_fecha)->addMonth();
            } else {
                $ultima_fecha = Carbon::parse($cliente->fecha_pago);
            }
            $factura_fecha = Carbon::parse($ultima_fecha);

            if ($factura_fecha->gt($hoy)) {
                //no
                /*$this->confirmToastBootstrap(null, [
                    'type' => 'warning',
                    'title' => "¡No se puede Generar la Factura!",
                    'message' => 'Aún no se ha alcanzado la fecha de pago del cliente para la proxima factura.'
                ]);*/
                return false;
            } else {

                if (!$ultima) {
                    $factura_fecha = $hoy->format('Y') . "-" . $hoy->format('m') . "-" . Carbon::parse($cliente->fecha_pago)->format('d');
                }

                //montos factura
                $factura_subtotal = $plan->precio;
                $factura_iva = null;
                $factura_total = $plan->precio;

                //Guardamos Factura
                $factura = new Factura();
                $factura->factura_numero = $factura_numero;
                $factura->factura_fecha = $factura_fecha;
                $factura->factura_subtotal = $factura_subtotal;
                $factura->factura_iva = $factura_iva;
                $factura->factura_total = $factura_total;
                $factura->servicios_codigo = $servicio->codigo;
                $factura->organizacion_nombre = $organizacion->nombre;
                $factura->organizacion_email = $organizacion->email;
                $factura->organizacion_telefono = $organizacion->telefono;
                $factura->organizacion_web = $organizacion->web;
                $factura->organizacion_moneda = $organizacion->moneda;
                $factura->organizacion_direccion = $organizacion->direccion;
                $factura->organizacion_representante = $organizacion->representante;
                $factura->organizacion_rif = $organizacion->rif;
                $factura->organizacion_imagen = $imagen;
                $factura->organizacion_mini = $mini;
                $factura->cliente_cedula = $cliente->cedula;
                $factura->cliente_nombre = $cliente->nombre;
                $factura->cliente_apellido = $cliente->apellido;
                $factura->cliente_email = $cliente->email;
                $factura->cliente_telefono = $cliente->telefono;
                $factura->cliente_latitud = $cliente->latitud;
                $factura->cliente_longitud = $cliente->longitud;
                $factura->cliente_gps = $cliente->gps;
                $factura->cliente_fecha_instalacion = $cliente->fecha_instalacion;
                $factura->cliente_fecha_pago = $cliente->fecha_pago;
                $factura->cliente_direccion = $cliente->direccion;
                $factura->plan_nombre = $plan->nombre;
                $factura->plan_etiqueta = $plan->etiqueta_factura;
                $factura->plan_bajada = $plan->bajada;
                $factura->plan_subida = $plan->subida;
                $factura->plan_precio = $plan->precio;
                $factura->servicios_id = $servicio->id;
                $factura->clientes_id = $cliente->id;
                $factura->organizaciones_id = $organizacion->id;
                $factura->planes_id = $plan->id;
                do{
                    $rowquid = generarStringAleatorio(16);
                    $existe = Factura::where('rowquid', $rowquid)->first();
                }while($existe);
                $factura->rowquid = $rowquid;
                $factura->save();

                //verificar Pagos adelantados
                $pago = Pago::where('clientes_id', $cliente->id)
                        ->where('facturas_id', null)
                        ->orderBy('fecha', 'ASC')
                        ->first();
                if ($pago) {
                    $pago->factura_numero = $factura->factura_numero;
                    $pago->facturas_id = $factura->id;
                    $pago->save();
                    $factura->pagos_id = $pago->id;
                    $factura->estatus = 1;
                    $factura->save();
                }

                $organizacion->proxima_factura = ++$next;
                $organizacion->save();

                //$this->toastBootstrap('info', 'Factura Generada.');
                $this->facturaRowquid = $factura->rowquid;
                return true;
            }

        }else{
            return false;
        }
    }

    protected function sendFacturaTrait($rowquid): bool
    {
        $factura = Factura::where('rowquid', $rowquid)->first();
        if ($factura){

            $filename = $this->getPdfFacturaTrait($factura, 'save');

            //anexamos los datos extras en data para enviar email
            $month = mesEspanol(getFecha($factura->factura_fecha, 'm'));
            $year = getFecha($factura->factura_fecha, 'Y');
            $data['from_email'] = getCorreoSistema();
            $data['from_name'] = config('app.name');
            $data['reply_email'] = strtolower($factura->organizacion_email);
            $data['reply_name'] = strtoupper($factura->organizacion_nombre);
            $data['subject'] = "Factura servicio de Internet $month $year";
            $data['path'] = "public/$filename";
            $data['filename'] = "Factura $month $year.pdf";
            $data['nombre'] = strtoupper($factura->cliente_nombre);
            $data['apellido'] = strtoupper($factura->cliente_apellido);
            $data['mes'] = strtoupper($month);
            $data['telefono'] = getTelefonoSistema();
            $data['email'] = getCorreoSistema();

            //enviamos el correo
            $to = $factura->cliente_email;
            Mail::to($to)->send(new FacturasMail($data));

            $path = Storage::exists($data['path']);
            if ($path) {
                Storage::delete($data['path']);
            }

            $factura->send = true;
            $factura->save();
            //$this->toastBootstrap('info', 'Factura Enviada.');
            $this->facturaNumero = $factura->factura_numero;
            return true;
        }else{
            return false;
        }
    }

    protected function getPdfFacturaTrait($factura, $out = "stream"): \Illuminate\Http\Response|string
    {
        $imagen = asset('img/logo.png');
        if ($factura->organizacion_mini){
            $imagen = verImagen($factura->organizacion_mini, false, true);
        }

        $pago = false;
        $metodo = '';
        $referencia = '';
        $banco = '';
        $monto = '';
        $fecha = '';
        $notas = '';
        if ($factura->estatus == 1){
            $pago = true;
            $metodo = getMetodoPago($factura->pago->metodo);
            $referencia = strtoupper($factura->pago->referencia);
            $banco = $factura->pago->nombre;
            $monto = $factura->pago->moneda.' '.formatoMillares($factura->pago->monto);
            $fecha = getFecha($factura->pago->fecha);
        }else{
            if ($factura->pagos_id){
                if ($factura->pago->estatus == 0){
                    $notas = "Esta factura tiene un pago registrado esperando validación.";
                }
                if ($factura->pago->estatus == 2){
                    $notas = "Esta factura tiene un pago registrado que fue rechazado porque no se pudo comprobar la operación.";
                }
            }
        }

        $data = [
            'imagen' => $imagen,
            'factura_fecha' => ucfirst(fechaEnLetras($factura->factura_fecha, "MMMM D[,] YYYY")),
            'factura_numero' => strtoupper($factura->factura_numero),
            'organizacion_nombre' => strtoupper($factura->organizacion_nombre),
            'organizacion_rif' => strtoupper($factura->organizacion_rif),
            'organizacion_representante' => strtoupper('Frank Sierra'),
            'organizacion_telefono' => strtoupper($factura->organizacion_telefono),
            'organizacion_email' => strtolower($factura->organizacion_email),
            'organizacion_direccion' => ucfirst($factura->organizacion_direccion),
            'organizacion_moneda' => $factura->organizacion_moneda,
            'cliente_cedula' => strtoupper($factura->cliente_cedula),
            'cliente_nombre' => strtoupper($factura->cliente_nombre.' '.$factura->cliente_apellido),
            'cliente_email' => strtolower($factura->cliente_email),
            'cliente_telefono' => strtoupper($factura->cliente_telefono),
            'cliente_direccion' => ucfirst($factura->cliente_direccion),
            'plan_servicio' => strtoupper($factura->plan_etiqueta .' ('. mesEspanol(getFecha($factura->factura_fecha, 'm')) .')'),
            'total' => formatoMillares($factura->factura_total),
            'pago' => $pago,
            'metodo' => $metodo,
            'referencia' => $referencia,
            'banco' => $banco,
            'monto' => $monto,
            'fecha_pago' => $fecha,
            'notas' => $notas
        ];
        //creamos el PDF y lo guardamos en Storage => public
        $filename = "sendFacturaID_$factura->rowquid.pdf";
        $pdf = Pdf::loadView('dashboard._export.pdf_factura', $data);

        if ($out == "stream"){
            return $pdf->stream('Factura_'.strtoupper($factura->factura_numero).'.pdf');
        }else{
            $pdf->save($filename, 'public');
            return $filename;
        }
    }

    protected function getServiciosTrait(): \Illuminate\Support\Collection
    {
        $data = [];
        $servicios = Servicio::all();
        foreach ($servicios as $servicio){
            $data[] = [
                'id' => $servicio->id,
                'fecha' => getFecha($servicio->cliente->fecha_pago, 'd'),
                'cliente' => $servicio->cliente->nombre." ".$servicio->cliente->apellido
            ];
        }
        return collect($data)->sortBy('fecha');
    }

    protected function avisoDeCorteTrait(): void
    {
        $hoy = Carbon::now();

        $facturas = Factura::where('estatus', 0)->where('aviso_corte', 0)->get();
        foreach ($facturas as $factura){
            $organizacion = Organizacion::find($factura->organizaciones_id);
            $diasFactura = $organizacion->dias_factura;
            $fechaCorte = Carbon::parse($factura->factura_fecha)->addDays($diasFactura);
            $aviso = $fechaCorte->subDay();
            if ($hoy->gte($aviso)){
                $data = [
                    'from_email' => getCorreoSistema(),
                    'from_name' => config('app.name'),
                    'subject' => 'Aviso de corte de servicio',
                    'cliente_nombre' => strtoupper($factura->cliente_nombre.' '. $factura->cliente_apellido),
                    'factura_numero' => strtoupper($factura->factura_numero),
                    'factura_total' => formatoMillares($factura->factura_total),
                    'plan_etiqueta' => strtoupper($factura->plan_etiqueta),
                    'fecha_corte' => getFecha($fechaCorte),
                    'organizacion_moneda' => $factura->organizacion_moneda,
                    'email' => getCorreoSistema(),
                    'telefono' => getTelefonoSistema()
                ];
                $to = $factura->cliente_email;
                Mail::to($to)->send(new AvisoCorteMail($data));
                $factura->aviso_corte = 1;
                $factura->save();
            }
        }
        //$this->alert('success', 'Factura Generada.');
    }

    protected function showPdfFacturaTrait($rowquid): void
    {
        if ($this->verPDF){
            $path = Storage::exists('public/'.$this->verPDF);
            if ($path) {
                Storage::delete('public/'.$this->verPDF);
            }
            $this->reset(['verPDF']);
        }

        $factura = Factura::where('rowquid', $rowquid)->first();
        if ($factura){
            $this->verPDF = $this->getPdfFacturaTrait($factura, 'save');
            $this->dispatch('initModalVerPDF', pdf: $this->verPDF, title: 'Factura', codigo: $factura->factura_numero);
        }
    }
}
