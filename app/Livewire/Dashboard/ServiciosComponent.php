<?php

namespace App\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Parametro;
use App\Models\Plan;
use App\Models\Servicio;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ServiciosComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $planes = array(), $nuevo = true, $editar = false, $servicios_id, $keyword;
    public $cliente, $organizacionesID, $planes_id, $codigo;
    public $cedula, $nombre, $apellido, $email, $telefono, $pago, $organizacion, $plan;
    public $cerrarModal= true, $show = false;
    public $facturarAutomatico = 0, $idParametro, $nameParametro = 'facturar_automatico';

    public function mount()
    {
        $this->setLimit();
        $parametro = Parametro::where('nombre', '=', $this->nameParametro)->first();
        if ($parametro){
            $this->idParametro = $parametro->id;
            $this->facturarAutomatico = $parametro->valor;
        }
    }

    public function render()
    {
        $organizaciones = Organizacion::all();

        $servicios = Servicio::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $rows = Servicio::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        return view('livewire.dashboard.servicios-component')
            ->with('organizaciones', $organizaciones)
            ->with('servicios', $servicios)
            ->with('rowsServicios', $rows);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < $this->numero) {
            $rows = $this->numero;
        } else {
            $rows = numRowsPaginate();
        }
        $this->rows = $this->rows + $rows;
    }

    #[On('limpiar')]
    public function limpiar()
    {
        $this->reset([
            'cliente', 'organizacionesID', 'planes_id', 'codigo', 'servicios_id',
            'nuevo', 'editar', 'keyword',
            'cedula', 'nombre', 'apellido', 'email', 'telefono', 'pago', 'organizacion', 'plan',
            'show'
        ]);
        $this->resetErrorBag();

        $clientes = Cliente::orderBy('nombre', 'ASC')->get();
        $data = array();
        foreach ($clientes as $row){
            $option = [
                'id' => $row->id,
                'text' => mb_strtoupper($row->cedula." | ".$row->nombre." ".$row->apellido)
            ];
            array_push($data, $option);
        }
        $this->dispatch('getSelectClientes', clientes: $data);
    }

    protected function rules()
    {
        return [
            'cliente' => ['required', Rule::unique('servicios', 'clientes_id')->where(fn (Builder $query) => $query->where('deleted_at', null))->ignore($this->servicios_id)],
            'organizacionesID' => 'required',
            'planes_id' => 'required',
        ];
    }

    protected $messages = [
        'cliente.unique' => 'El cliente ya tiene un servicio registrado.',
        'organizacionesID.required' => 'El campo organización es obligatorio.',
        'planes_id.required' => 'El campo plan de servicio es obligatorio.',
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
            $this->codigo = nextCodigo('proximo_codigo_servicios', $this->organizacionesID, 'formato_codigo_servicios');
        }

        if ($servicios){

            $servicios->codigo = $this->codigo;
            $servicios->clientes_id = $this->cliente;
            $servicios->organizaciones_id = $this->organizacionesID;
            $servicios->planes_id = $this->planes_id;
            $servicios->save();

            $this->alert('success', 'Datos Guardados.');

        }

        if ($this->cerrarModal){
            $this->limpiar();
            $this->dispatch('cerrarModal');
        }else{
            $this->showServicio($servicios->id);
        }

    }

    public function edit($id, $cerrarModal = true)
    {
        $this->limpiar();
        $servicio = Servicio::find($id);
        if ($servicio){

            $this->codigo = $servicio->codigo;
            $this->cliente = $servicio->clientes_id;
            $this->organizacionesID = $servicio->organizaciones_id;
            $this->updatedOrganizacionesID();
            $this->planes_id = $servicio->planes_id;

            $this->cedula = $servicio->cliente->cedula;
            $this->nombre = $servicio->cliente->nombre;
            $this->apellido = $servicio->cliente->apellido;
            $this->telefono = $servicio->cliente->telefono;
            $this->email = $servicio->cliente->email;
            $this->pago = $servicio->cliente->fecha_pago;

            $this->plan = $servicio->plan->nombre;
            $this->organizacion = $servicio->organizacion->nombre;

            $this->nuevo = false;
            $this->editar = true;
            $this->servicios_id = $servicio->id;

            $this->dispatch('setSelectClientes', cliente: $this->cliente);
            $this->dispatch('setPlan', plan: $servicio->planes_id);

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            $this->dispatch('cerrarModal');
        }

    }

    public function showServicio($id)
    {
        $this->edit($id, false);
        $this->show = true;
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

    #[On('confirmed')]
    public function confirmed()
    {
        $servicio  = Servicio::find($this->servicios_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;
        $factura = Factura::where('servicios_id', $this->servicios_id)->first();
        if ($factura){
            $vinculado = true;
        }

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

            if ($servicio){
                $servicio->delete();
                $this->alert('success', 'Servicio Eliminado.');
            }

            $this->limpiar();
            $this->dispatch('cerrarModal');
            $this->dispatch('limpiarFacturas');
        }
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function updatedOrganizacionesID()
    {
        $this->reset('planes_id');
        $this->planes = Plan::where('organizaciones_id', $this->organizacionesID)->get();
    }

    #[On('getCliente')]
    public function getCliente($id)
    {
        $this->cliente = $id;
    }

    #[On('getSelectClientes')]
    public function getSelectClientes($clientes)
    {
        //JS
    }

    #[On('setSelectClientes')]
    public function setSelectClientes($cliente)
    {
        //JS
    }

    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
    }

    #[On('setPlan')]
    public function setPlan($plan)
    {
        //JS
    }

    public function btnFacturarAutomatico()
    {
        if (!$this->facturarAutomatico){
            $this->facturarAutomatico = 1;
        }else{
            $this->facturarAutomatico = 0;
        }
        if ($this->idParametro){
            $parametro = Parametro::find($this->idParametro);
        }else{
            $parametro = new Parametro();
        }
        $parametro->nombre = $this->nameParametro;
        $parametro->valor = $this->facturarAutomatico;
        $parametro->save();
        $this->idParametro = $parametro->id;
    }

}
