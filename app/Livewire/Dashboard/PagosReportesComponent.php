<?php

namespace App\Livewire\Dashboard;

use App\Exports\PagosExport;
use App\Models\Pago;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class PagosReportesComponent extends Component
{
    use ToastBootstrap;

    public $filtro = 'all', $desde, $hasta;

    public function render()
    {
        return view('livewire.dashboard.pagos-reportes-component');
    }

    #[On('limpiar')]
    public function limpiar()
    {
        $this->reset(['filtro', 'desde', 'hasta']);
        $this->resetErrorBag();
    }

    public function generarReporte()
    {
        $rules = [
            'desde' => 'required',
            'hasta' => 'required|after_or_equal:desde',
        ];
        $this->validate($rules);

        if ($this->filtro == 'all'){
            $name = "Todos";
            $pagos = Pago::whereBetween('fecha', [$this->desde, $this->hasta])->orderBy('fecha')->get();
        }else{
            $name = ucfirst($this->filtro);
            $pagos = Pago::whereBetween('fecha', [$this->desde, $this->hasta])->where('metodo', $this->filtro)->orderBy('fecha')->get();
        }

        $this->toastBootstrap('info', 'Descarga Iniciada.');
        return Excel::download(new PagosExport($pagos), "Pagos_$name.xlsx");
    }

}
