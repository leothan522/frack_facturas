<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Parametro;
use App\Models\Plan;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class FacturasComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'getSelectClientes', 'setSelectClientes', 'getCliente', 'cerrarModalServicios', 'confirmed'
    ];

    public $planes = array(), $nuevo = true, $editar = false, $viewFactura = false, $servicios_id, $keyword;
    public $cliente, $organizacion, $plan, $codigo;
    public $nombreCliente, $nombrePlan, $nombreOrganizacion, $listarFacturas;


    public function render()
    {
        $organizaciones = Organizacion::all();
        $servicios = Servicio::buscar($this->keyword)->orderBy('updated_at', 'DESC')->paginate(numRowsPaginate(), ['*'], 'pageServicio');
        return view('livewire.dashboard.facturas-component')
            ->with('organizaciones', $organizaciones)
            ->with('servicios', $servicios);
    }

    public function limpiar()
    {
        $this->reset([
            'cliente', 'organizacion', 'plan', 'codigo', 'servicios_id', 'keyword', 'viewFactura'
        ]);
        $this->resetErrorBag();

        $clientes = Cliente::orderBy('nombre', 'ASC')->get();
        $data = array();
        foreach ($clientes as $row){
            $option = [
                'id' => $row->id,
                'text' => $row->cedula." | ".$row->nombre
            ];
            array_push($data, $option);
        }
        $this->emit('getSelectClientes', $data);
    }

    protected function rules()
    {
        return [
            'cliente' => ['required', Rule::unique('servicios', 'clientes_id')->where(fn (Builder $query) => $query->where('deleted_at', null))->ignore($this->servicios_id)],
            //'email' => Rule::unique('servicios', 'clientes_id')->where(fn (Builder $query) => $query->where('deleted_at', null)),
            'organizacion' => 'required',
            'plan' => 'required',
        ];
    }

    protected $messages = [
        'cliente.unique' => 'El cliente ya tiene un servicio registrado',
    ];

    public function save()
    {
        $this->validate();

        if ($this->servicios_id){
            //editar
            $servicios = Servicio::find($this->servicios_id);
        }else{
            //nuevo
            $servicios = new Servicio();

            $parametros = Parametro::where('nombre', 'next_codigo_servicios')->where('tabla_id', $this->organizacion)->first();
            if ($parametros){
                $next = $parametros->valor;
            }else{
                $next = 0;
                $parametros = new Parametro();
                $parametros->nombre = 'next_codigo_servicios';
                $parametros->tabla_id = $this->organizacion;
            }
            $i = 1;
            do{
                $next = $next + $i;
                $codigo = nextCodigo($next, 'formato_codigo_servicios', $this->organizacion);
                $existe = Servicio::where('codigo', $codigo)->count();
                if ($existe){ $i++; }
            }while($existe);
            $servicios->codigo = $codigo;
        }
        $servicios->clientes_id = $this->cliente;
        $servicios->organizaciones_id = $this->organizacion;
        $servicios->planes_id = $this->plan;
        $servicios->save();

        if (!$this->servicios_id){
            $parametros->valor = $next;
            $parametros->save();
        }

        $this->limpiar();
        $this->emit('cerrarModalServicios');
        $this->alert('success', 'Datos Guardados.');
    }

    public function edit($id)
    {
        $this->limpiar();
        $servicio = Servicio::find($id);
        $this->codigo = $servicio->codigo;
        $this->cliente = $servicio->clientes_id;
        $this->organizacion = $servicio->organizaciones_id;
        $this->updatedOrganizacion();
        $this->plan = $servicio->planes_id;
        $this->nuevo = false;
        $this->editar = true;
        $this->servicios_id = $servicio->id;
        $this->emit('setSelectClientes', $this->cliente);
        $this->nombreCliente = $servicio->cliente->nombre." ".$servicio->cliente->apellido;
        $this->nombrePlan = $servicio->plan->nombre;
        $this->nombreOrganizacion = $servicio->organizacion->nombre;
    }

    public function destroy($id)
    {
        $this->servicios_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => '¡Sí, bórralo!',
            'text' => '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $servicio  = Servicio::find($this->servicios_id);

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
            $servicio->delete();
            $this->alert(
                'success',
                'Servicio Eliminado.'
            );
            $this->limpiar();
            $this->emit('cerrarModalServicios');
        }
    }

    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function updatedOrganizacion()
    {
        $this->reset('plan');
        $this->planes = Plan::where('organizaciones_id', $this->organizacion)->get();
    }

    public function getCliente($id)
    {
        $this->cliente = $id;
    }

    public function getSelectClientes($clientes)
    {
        //JS
    }

    public function setSelectClientes($cliente)
    {
        //JS
    }
    public function cerrarModalServicios()
    {
        //JS
    }

    public function limpiarFactuas()
    {
        $this->limpiar();
        $this->reset([
            'nombreCliente', 'nombrePlan', 'nombreOrganizacion', 'listarFacturas'
        ]);
    }

    public function getFacturas($id)
    {
        $this->edit($id);
        $this->listarFacturas = Factura::where('servicios_id', $this->servicios_id)
            ->orderBy('factura_fecha', 'DESC')->limit(12)->get();
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
