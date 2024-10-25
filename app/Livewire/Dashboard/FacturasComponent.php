<?php

namespace App\Livewire\Dashboard;

use App\Mail\FacturasMail;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class FacturasComponent extends Component
{
    use LivewireAlert;

    public $viewFactura = false, $limit = 12, $botonMasFacturas = false;
    public $codigo, $cliente, $plan, $organizacion, $fecha_pago, $listarFacturas;

    #[Locked]
    public $servicios_id, $servicioRowquid, $facturas_id, $facturaRowquid;

    public function render()
    {
        return view('livewire.dashboard.facturas-component');
    }

    #[On('limpiarFacturas')]
    public function limpiarFacturas()
    {
        $this->reset([
            'viewFactura', 'botonMasFacturas', 'limit'
        ]);
    }

    #[On('getFacturas')]
    public function getFacturas($rowquid)
    {
        if ($this->servicioRowquid != $rowquid) {
            $this->servicioRowquid = $rowquid;
            $this->limpiarFacturas();
        }

        $servicio = $this->getServicio($this->servicioRowquid);

        if ($servicio) {

            $this->servicios_id = $servicio->id;
            $this->codigo = $servicio->codigo;
            $this->cliente = $servicio->cliente->nombre . " " . $servicio->cliente->apellido;
            $this->plan = $servicio->plan->nombre;
            $this->organizacion = $servicio->organizacion->nombre;
            $this->fecha_pago = $servicio->cliente->fecha_pago;

            $this->listarFacturas = Factura::where('servicios_id', $this->servicios_id)
                ->orderBy('factura_fecha', 'DESC')
                ->limit($this->limit)
                ->get();

            $facturas = Factura::where('servicios_id', $this->servicios_id)->count();

            $actual = $this->listarFacturas->count();
            if ($facturas > 12 && $facturas > $actual) {
                $this->botonMasFacturas = true;
            } else {
                $this->botonMasFacturas = false;
            }

            $this->viewFactura = true;

        } else {
            $this->reset(['servicios_id', 'servicioRowquid']);
        }

    }

    public function generarFactura()
    {
        $servicio = Servicio::find($this->servicios_id);

        if ($servicio) {

            $organizacion = Organizacion::find($servicio->organizaciones_id);
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
                $this->alert('warning', '¡No se puede Generar la Factura!', [
                    'position' => 'center',
                    'timer' => '',
                    'toast' => false,
                    'text' => 'Aún no se ha alcanzado la fecha de pago del cliente para la proxima factura.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'OK',
                ]);

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

                $this->getFacturas($this->servicioRowquid);

                $organizacion->proxima_factura = ++$next;
                $organizacion->save();

                $this->alert('success', 'Factura Generada.');
            }

        }

    }

    public function verMasFacturas($limit)
    {
        $this->limit = $limit + 12;
        $this->getFacturas($this->servicioRowquid);
    }

    public function destroyFactura($rowquid)
    {
        $this->facturaRowquid = $rowquid;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => '¡Sí, bórralo!',
            'text' => '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedFactura',
        ]);
    }

    #[On('confirmedFactura')]
    public function confirmedFactura()
    {
        $row = $this->getFactura($this->facturaRowquid);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            if ($row) {
                $row->delete();
                $this->alert('success', 'Factura Eliminada.');
            }
            $this->reset('facturas_id', 'facturaRowquid');
            $this->getFacturas($this->servicioRowquid);
        }
    }

    public function sendFactura($rowquid)
    {
        $factura = $this->getFactura($rowquid);
        if ($factura){
            $data = [
                'factura' => $factura
            ];
            //creamos el PDF y lo guardamos en Storage => public
            $filename = "sendFacturaID_$factura->rowquid.pdf";
            $pdf = Pdf::loadView('dashboard._export.pdf_factura', $data);
            $pdf->save($filename, 'public');

            //anexamos los datos extras en data para enviar email
            $month = mesEspanol(getFecha($factura->factura_fecha, 'm'));
            $year = getFecha($factura->factura_fecha, 'Y');
            $data['from_email'] = $factura->organizacion_email;
            $data['from_name'] = $factura->organizacion_nombre;
            $data['subject'] = "Factura servicio de Internet $month $year";
            $data['path'] = "public/$filename";
            $data['filename'] = "Factura $month $year.pdf";

            //enviamos el correo
            $to = $factura->cliente_email;
            Mail::to($to)->send(new FacturasMail($data));

            $path = Storage::exists($data['path']);
            if ($path) {
                Storage::delete($data['path']);
            }

            $factura->send = true;
            $factura->save();
            $this->getFacturas($this->servicioRowquid);

            $this->alert("success", 'Factura Enviada.');
        }
    }

    public function reSendFactura($rowquid)
    {
        $this->facturaRowquid = $rowquid;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => '¡Sí, volver a enviar!',
            'text' => '¡Esta Factura ya fue enviada anteriormente!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedEnviar',
        ]);
    }

    #[On('confirmedEnviar')]
    public function confirmedEnviar()
    {
        $this->sendFactura($this->facturaRowquid);
        $this->reset('facturas_id', 'facturaRowquid');
    }

    protected function getServicio($rowquid): ?Servicio
    {
        return Servicio::where('rowquid', $rowquid)->first();
    }

    protected function getFactura($rowquid): ?Factura
    {
        return Factura::where('rowquid', $rowquid)->first();
    }

}
