<?php

namespace App\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PruebasComponent extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.dashboard.pruebas-component');
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
                $next = $organizacion->proxima_factura;
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
                    $ultima_fecha = $year."-".Carbon::parse($cliente->fecha_pago)->format('m-d');
                }
                $factura_fecha = Carbon::parse($ultima_fecha);

                if (!$factura_fecha->gt($hoy)){

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
                    $factura->save();

                    $organizacion->proxima_factura = ++$next;
                    $organizacion->save();

                }
            }
        }

        //dd($servicio);

        $this->alert('success', 'Factura Generada.');
    }

}
