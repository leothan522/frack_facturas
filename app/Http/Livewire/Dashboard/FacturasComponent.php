<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class FacturasComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'getFacturas', 'confirmedFactura'
    ];

    public $viewFactura = false, $limit = 12, $servicios_id, $botonMasFacturas = false;
    public $codigo, $cliente, $plan, $organizacion, $fecha_pago, $listarFacturas, $facturas_id;

    public function render()
    {
        return view('livewire.dashboard.facturas-component');
    }

    public function limpiarFacturas()
    {
        $this->reset([
            'viewFactura', 'botonMasFacturas', 'limit'
        ]);
    }

    public function getFacturas($id)
    {
        if ($this->servicios_id != $id){
            $this->servicios_id = $id;
            $this->limpiarFacturas();
        }

        $servicio = Servicio::find($this->servicios_id);
        $this->codigo = $servicio->codigo;
        $this->cliente = $servicio->cliente->nombre." ".$servicio->cliente->apellido;
        $this->plan = $servicio->plan->nombre;
        $this->organizacion = $servicio->organizacion->nombre;
        $this->fecha_pago = $servicio->cliente->fecha_pago;

        $this->listarFacturas = Factura::where('servicios_id', $this->servicios_id)
            ->orderBy('factura_fecha', 'DESC')->limit($this->limit)->get();

        $facturas = Factura::where('servicios_id', $this->servicios_id)->count();
        $actual = $this->listarFacturas->count();
        if ($facturas > 12 && $facturas > $actual){
            $this->botonMasFacturas = true;
        }else{
            $this->botonMasFacturas = false;
        }

        $this->viewFactura = true;
    }

    public function generarFactura()
    {
        $servicio = Servicio::find($this->servicios_id);
        $organizacion = Organizacion::find($servicio->organizaciones_id);
        $cliente = Cliente::find($servicio->clientes_id);
        $plan = Plan::find($servicio->planes_id);

        $hoy = Carbon::parse(date("Y-m-d"));

        //numero Factura
        $next = $organizacion->proxima_factura;
        $formato = $organizacion->formato_factura;
        $i = 0;
        do{
            $next = $next + $i;
            $factura_numero = cerosIzquierda($formato . $next, numSizeCodigo());
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

        if ($factura_fecha->gt($hoy)){
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

        }else{

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

            $this->getFacturas($this->servicios_id);

            $organizacion->proxima_factura = ++$next;
            $organizacion->save();

            $this->alert('success', 'Factura Generada.');
        }

    }

    public function verMasFacturas($limit)
    {
        $this->limit = $limit + 12;
        $this->getFacturas($this->servicios_id);
    }

    public function destroy($id)
    {
        $this->facturas_id = $id;
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

    public function confirmedFactura()
    {
        $row  = Factura::find($this->facturas_id);

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
            $row->delete();
            $this->alert(
                'success',
                'Factura Eliminada.'
            );
            $this->reset('facturas_id');
            $this->getFacturas($this->servicios_id);
        }
    }

}
