<?php

namespace App\Livewire\Dashboard;

use App\Models\Pago;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PagosComponent extends Component
{
    use LivewireAlert;
    use WithPagination, WithoutUrlPagination;

    public $view = 'table',$order = 'DESC', $keyword;

    public function render()
    {
        $pagos = Pago::buscar($this->keyword)
            ->orderBy('fecha', $this->order)
            //->orderBy('numero', $this->order)
            //->orderBy('created_at', 'DESC')
            ->paginate(50);

        $rows = Pago::buscar($this->keyword)->count();

        return view('livewire.dashboard.pagos-component')
            ->with('pagos', $pagos)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->reset([
            'view',
        ]);
        $this->resetErrorBag();
    }

    public function orderAscending(){
        $this->order = 'ASC';
    }

    public function orderDescending(){
        $this->order = 'DESC';
    }

    public function buscar()
    {
        $this->resetPage();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->resetPage();
    }

    public function actualizar()
    {
        $this->resetPage();
        $this->limpiar();
    }

}
