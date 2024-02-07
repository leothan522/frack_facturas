<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Organizacion;
use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class FacturasComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['getSelectClientes', 'setSelectClientes', 'getCliente'];

    public $planes = array(), $nuevo = true, $editar = false;
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
            'cliente', 'organizacion', 'plan'
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
