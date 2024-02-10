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
        'getFacturas'
    ];

    public $viewFactura = false,$limit = 12, $servicios_id, $botonMasFacturas = false;
    public $codigo, $cliente, $plan, $organizacion, $listarFacturas;

    public function render()
    {
        return view('livewire.dashboard.facturas-component');
    }

    public function limpiarFacturas()
    {
        $this->reset([
            'codigo', 'cliente', 'plan', 'organizacion', 'viewFactura', 'listarFacturas', 'botonMasFacturas'
        ]);
    }

    public function getFacturas($id)
    {
        $this->servicios_id = $id;

        $servicio = Servicio::find($id);
        $this->codigo = $servicio->codigo;
        $this->cliente = $servicio->cliente->nombre." ".$servicio->cliente->apellido;
        $this->plan = $servicio->plan->nombre;
        $this->organizacion = $servicio->organizacion->nombre;

        $this->listarFacturas = Factura::where('servicios_id', $this->servicios_id)
            ->orderBy('factura_fecha', 'DESC')->limit($this->limit)->get();

        $facturas = Factura::where('servicios_id', $this->servicios_id)->count();
        $actual = $this->listarFacturas->count();
        if ($facturas > 12 && $this->limit < $actual){
            $this->botonMasFacturas = true;
        }
        $this->viewFactura = true;
    }

    public function generarFactura()
    {
        $servicio = Servicio::find($this->servicios_id);
        $organizacion = Organizacion::find($servicio->organizaciones_id);
        $cliente = Cliente::find($servicio->clientes_id);
        $plan = Plan::find($servicio->planes_id);

        //numero Fcaura
        $next = $organizacion->proxima_factura;
        $formato = $organizacion->formato_factura;
        $i = 0;
        do{
            $next = $next + $i;
            $factura_numero = nextCodigo($next, null, null, $formato);
            $existe = Factura::where('factura_numero', $factura_numero)->where('organizaciones_id', $organizacion->id)->first();
            if ($existe){ $i++; }
        }while($existe);

        //fecha factura
        $ultima = Factura::where('servicios_id', $servicio->id)->orderBy('factura_fecha', 'DESC')->first();
        if ($ultima) {
            $ultima_fecha = Carbon::parse($ultima->factura_fecha)->addMonth();
        }else{
            $ultima_fecha = $cliente->fecha_pago;
        }
        $factura_fecha = $ultima_fecha;

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
        $factura->plan_bajada = $plan->bajada;
        $factura->plan_subida = $plan->subida;
        $factura->plan_precio = $plan->precio;
        $factura->servicios_id = $servicio->id;
        $factura->clientes_id = $cliente->id;
        $factura->organizaciones_id = $organizacion->id;
        $factura->planes_id = $plan->id;
        $factura->save();

        $this->getFacturas($this->servicios_id);

        $this->alert('success', 'Factura Generada.');
    }

}
