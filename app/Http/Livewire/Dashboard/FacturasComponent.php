<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class FacturasComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['getSelectClientes', 'setSelectClientes', 'getCliente'];

    public $planes = array(), $nuevo = true, $editar = false, $servicios_id;
    public $cliente, $organizacion, $plan;


    public function render()
    {
        $organizaciones = Organizacion::all();
        return view('livewire.dashboard.facturas-component')
            ->with('organizaciones', $organizaciones);
    }

    public function limpiar()
    {
        $this->reset([
            'cliente', 'organizacion', 'plan', 'servicios_id'
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
            'cliente' => 'required',
            'organizacion' => 'required',
            'plan' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->servicios_id){
            //editar
            $servicios = Servicio::find($this->servicios_id);
        }else{
            //nuevo
            $servicios = new Servicio();
        }

        $next = Servicio::where('organizaciones_id', $this->organizacion)->count();
        $i = 1;
        do{
            $next = $next + $i;
            $codigo = nextCodigo($next, 'formato_codigo_servicios', $this->organizacion);
            $existe = Servicio::where('codigo', $codigo)->first();
            if ($existe){ $i++; }
        }while($existe);

        $servicios->codigo = $codigo;
        $servicios->clientes_id = $this->cliente;
        $servicios->organizaciones_id = $this->organizacion;
        $servicios->planes_id = $this->plan;
        $servicios->save();

        $this->limpiar();

        $this->alert('success', 'Datos Guardados.');

        /*$organizacion = Organizacion::find($this->organizacion);
        $next = $organizacion->proxima_factura;
        $i = 0;
        do{
            $next = $next + $i;
            $codigo = nextCodigo($next, 'formato_codigo_servicios', $this->organizacion);
            $existe = Servicio::where('codigo', $codigo)->first();
            if ($existe){ $i++; }
        }while($existe);

        $servicios->codigo = $codigo;
        $servicios->clientes_id = $this->cliente;
        $servicios->organizaciones_id = $this->organizacion;
        $servicios->planes_id = $this->plan;
        $servicios->save();

        if (!$this->servicios_id){
            $organizacion->proxima_factura = ++$next;
            $organizacion->save();
        }*/
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $this->cedula = $cliente->cedula;
        $this->nombre = $cliente->nombre;
        $this->apellido = $cliente->apellido;
        $this->email = $cliente->email;
        $this->telefono = $cliente->telefono;
        $this->direccion = $cliente->direccion;
        $this->instalacion = $cliente->fecha_instalacion;
        $this->pago = $cliente->fecha_pago;
        $this->latitud = $cliente->latitud;
        $this->longitud = $cliente->longitud;
        $this->gps = $cliente->gps;
        $this->nuevo = false;
        $this->editar = true;
        $this->cliente_id = $cliente->id;
    }

    public function destroy($id)
    {
        $this->cliente_id = $id;
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
        $cliente = Cliente::find($this->cliente_id);
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
            $cliente->delete();
            $this->alert(
                'success',
                'Cliente Eliminado.'
            );
            $this->limpiar();
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
}
