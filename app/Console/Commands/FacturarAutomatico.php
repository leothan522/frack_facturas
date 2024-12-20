<?php

namespace App\Console\Commands;

use App\Mail\AvisoCorteMail;
use App\Mail\FacturasMail;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Parametro;
use App\Models\Plan;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FacturarAutomatico extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facturar:automatico';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Facturas Generadas Automaticamente.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $parametro = Parametro::where('nombre', '=', 'facturar_automatico')->where('valor', '=', 1)->first();
        if ($parametro){
            $this->generarFacturas();
        }
        $this->avisoDeCorte();
    }

    public function generarFacturas()
    {
        $fecha = Carbon::now();
        $hoy = $fecha->format('Y-m-d');
        $dia = $fecha->format('d');
        $mes = $fecha->format('m');
        $year = $fecha->format('Y');

        $clientes = Cliente::whereDay('fecha_pago', '<=', $dia)
            ->whereMonth('fecha_pago', '<=', $mes)
            ->get();

        foreach ($clientes as $client){

            $servicio = Servicio::where('clientes_id', $client->id)->first();

            if ($servicio){

                $organizacion = Organizacion::find($servicio->organizaciones_id);
                $cliente = Cliente::find($servicio->clientes_id);
                $plan = Plan::find($servicio->planes_id);

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
                }else{
                    $ultima_fecha = Carbon::parse($cliente->fecha_pago);
                }
                $factura_fecha = Carbon::parse($ultima_fecha);

                if (!$factura_fecha->gt($hoy)){

                    if (!$ultima){
                        $factura_fecha = $year."-".$mes."-".Carbon::parse($cliente->fecha_pago)->format('d');
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
                    $factura->organizacion_imagen = $organizacion->imagen;
                    $factura->organizacion_mini = $organizacion->mini;
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

                    $organizacion->proxima_factura = ++$next;
                    $organizacion->save();


                    //sendFactura al correo
                    $filename = getPdfFactura($factura, 'save');

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
                    if ($path){
                        Storage::delete($data['path']);
                    }

                    $factura->send = true;
                    $factura->save();

                }
            }
        }

        //dd($servicio);

        //$this->alert('success', 'Factura Generada.');
    }

    public function avisoDeCorte()
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

}
