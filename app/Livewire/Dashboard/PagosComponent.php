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
    public $rows;
    public array $filtro = [
        'transferencia' => 'Tranferencias',
        'movil' => 'Pago Móvil',
        'zelle' => 'Zelle',
        'all'   => 'Todos'
    ];
    public $tipo = 'all';

    public function render()
    {
        $pagos = $this->getPagos();

        return view('livewire.dashboard.pagos-component')
            ->with('pagos', $pagos);
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
        $this->reset(['tipo']);
        $this->resetPage();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword', 'tipo']);
        $this->resetPage();
    }

    public function actualizar()
    {
        $this->resetPage();
        $this->limpiar();
    }

    protected function getPagos()
    {
        switch ($this->tipo) {
            case 'transferencia':

                $this->rows = Pago::buscar($this->keyword)
                    ->where('metodo', 'transferencia')
                    ->count();

                $pago = Pago::buscar($this->keyword)
                    ->where('metodo', 'transferencia')
                    ->orderBy('fecha', $this->order)
                    ->paginate(50);

                break;
                case 'movil':

                    $this->rows = Pago::buscar($this->keyword)
                        ->where('metodo', 'movil')
                        ->count();

                    $pago = Pago::buscar($this->keyword)
                        ->where('tipo', 'movil')
                        ->orderBy('fecha', $this->order)
                        ->paginate(50);

                    break;
                case 'zelle':

                    $this->rows = Pago::buscar($this->keyword)
                        ->where('metodo', 'zelle')
                        ->count();

                    $pago = Pago::buscar($this->keyword)
                        ->where('metodo', 'zelle')
                        ->orderBy('fecha', $this->order)
                        ->paginate(50);

                    break;
            default:

                $this->tipo = 'all';

                $this->rows = Pago::buscar($this->keyword)
                    ->count();

                $pago = Pago::buscar($this->keyword)
                    ->orderBy('fecha', $this->order)
                    ->paginate(50);

                break;
        }

        return $pago;
    }

    public function btnFiltro($filtro)
    {
        $this->tipo = $filtro;
    }

}
