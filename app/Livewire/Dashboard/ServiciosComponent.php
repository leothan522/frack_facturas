<?php

namespace App\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Parametro;
use App\Models\Plan;
use App\Models\Servicio;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ServiciosComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $keyword;
    public $cerrarModal= true, $show = false;
    public $facturarAutomatico = 0, $idParametro, $nameParametro = 'facturar_automatico';

    public $clienteRowquid, $organizacionRowquid, $planRowquid, $codigo;
    public $clientes_id, $organizaciones_id, $planes_id, $listarPlanes = array();
    public $cedula, $nombre, $apellido, $email, $telefono, $pago, $organizacion, $plan;

    #[Locked]
    public $servicios_id, $rowquid;

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

        $total = Servicio::buscar($this->keyword)->count();

        $rows = Servicio::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        return view('livewire.dashboard.servicios-component')
            ->with('listarOrganizaciones', $organizaciones)
            ->with('servicios', $servicios)
            ->with('rowsServicios', $rows)
            ->with('totalRows', $total);
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
            'servicios_id',
            'nuevo', 'editar',
            'cedula', 'nombre', 'apellido', 'email', 'telefono', 'pago', 'organizacion', 'plan',
            'show',
            'clienteRowquid', 'organizacionRowquid', 'planRowquid', 'codigo',
            'clientes_id', 'organizaciones_id', 'planes_id',
        ]);
        $this->resetErrorBag();

        $clientes = Cliente::orderBy('nombre', 'ASC')->get();
        $data = array();
        foreach ($clientes as $row){
            $option = [
                'id' => $row->rowquid,
                'text' => mb_strtoupper($row->cedula." | ".$row->nombre." ".$row->apellido)
            ];
            $data[] = $option;
        }
        $this->dispatch('getSelectClientes', clientes: $data);
    }

    protected function rules()
    {
        return [
            'clientes_id' => ['required', Rule::unique('servicios', 'clientes_id')->where(fn (Builder $query) => $query->where('deleted_at', null))->ignore($this->servicios_id)],
            'organizaciones_id' => 'required',
            'planes_id' => 'required',
        ];
    }

    protected $messages = [
        'clientes_id.required' => ' El campo cliente es obligatorio.',
        'clientes_id.unique' => 'El cliente ya tiene un servicio registrado.',
        'organizaciones_id.required' => 'El campo organización es obligatorio.',
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
            $this->codigo = nextCodigo('proximo_codigo_servicios', $this->organizaciones_id, 'formato_codigo_servicios');
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Servicio::where('rowquid', $rowquid)->first();
            }while($existe);
            $servicios->rowquid = $rowquid;
        }

        if ($servicios){

            $servicios->codigo = $this->codigo;
            $servicios->clientes_id = $this->clientes_id;
            $servicios->organizaciones_id = $this->organizaciones_id;
            $servicios->planes_id = $this->planes_id;
            $servicios->save();

            $this->alert('success', 'Datos Guardados.');

            if ($this->servicios_id){
                $this->reset('keyword');
            }

            if ($this->cerrarModal){
                $this->limpiar();
                $this->dispatch('cerrarModal');
            }else{
                $this->showServicio($servicios->rowquid);
            }

        }else{
            $this->dispatch('cerrarModal');
        }
    }

    public function edit($rowquid, $cerrarModal = true)
    {
        $this->limpiar();
        $servicio = $this->getServicio($rowquid);
        if ($servicio){

            $this->codigo = $servicio->codigo;
            $this->clienteRowquid = $servicio->cliente->rowquid;
            //$this->clientes_id = $servicio->clientes_id;
            $this->organizacionRowquid = $servicio->organizacion->rowquid;
            $this->updatedOrganizacionRowquid();
            //$this->organizaciones_id = $servicio->organizaciones_id;
            Sleep::for(500)->millisecond();
            $this->planRowquid = $servicio->plan->rowquid;
            $this->updatedPlanRowquid();
            //$this->planes_id = $servicio->planes_id;
            $this->rowquid = $servicio->rowquid;


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

            $this->dispatch('setSelectClientes', rowquid: $this->clienteRowquid);
            //$this->dispatch('setPlan', plan: $servicio->planes_id);

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            Sleep::for(500)->millisecond();
            $this->dispatch('cerrarModal');
        }

    }

    public function showServicio($rowquid)
    {
        $this->edit($rowquid, false);
        $this->show = true;
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
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
        $id = null;
        $servicio  = $this->getServicio($this->rowquid);
        if ($servicio){
            $id = $servicio->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;
        $factura = Factura::where('servicios_id', $id)->first();
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

    #[On('getSelectClientes')]
    public function getSelectClientes($clientes)
    {
        //JS
    }

    #[On('getClienteRowquid')]
    public function getClienteRowquid($rowquid)
    {
        $cliente = $this->getCliente($rowquid);
        if ($cliente){
            $this->clientes_id = $cliente->id;
        }
    }

    #[On('setSelectClientes')]
    public function setSelectClientes($rowquid)
    {
        //JS
    }

    public function updatedOrganizacionRowquid()
    {
        $organizacion = $this->getOrganizacion($this->organizacionRowquid);
        if ($organizacion){
            $this->organizaciones_id = $organizacion->id;
            $this->reset('planes_id', 'planRowquid');
            $this->listarPlanes = Plan::where('organizaciones_id', $organizacion->id)->get();
        }
    }

    public function updatedPlanRowquid()
    {
        $plan = $this->getPlan($this->planRowquid);
        if ($plan){
            $this->planes_id = $plan->id;
        }
    }

    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
    }

    public function cerrarBusqueda()
    {
        $this->reset('keyword');
        $this->limpiar();
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

    protected function getCliente($rowquid): ?Cliente
    {
        return Cliente::where('rowquid', $rowquid)->first();
    }

    protected function getOrganizacion($rowquid): ?Organizacion
    {
        return Organizacion::where('rowquid', $rowquid)->first();
    }

    protected function getPlan($rowquid): ?Plan
    {
        return Plan::where('rowquid', $rowquid)->first();
    }

    protected function getServicio($rowquid): ?Servicio
    {
        return Servicio::where('rowquid', $rowquid)->first();
    }

}
