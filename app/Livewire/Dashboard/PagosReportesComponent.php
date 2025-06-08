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

    #[On('initReporte')]
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

        if ($pagos->isNotEmpty()){
            $this->toastBootstrap('info', 'Descarga Iniciada.');
            return Excel::download(new PagosExport($pagos), "Pagos_$name.xlsx");
        }else{
            $html = '
                    <div class="row">
                        <div class="col-12 p-2">
                            <div class="small-box" style="box-shadow: none; min-height: 40px;">
                                <div class="overlay bg-light">
                                    <i class="far fa-4x fa-lightbulb opacity-75 text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-justify">
                            No existen pagos registrados entre el rango de fechas que has indicado.
                        </div>
                    </div>
                ';

            $this->htmlToastBoostrap(null, null, [
                'type' => 'warning',
                'message' => $html
            ]);
            return false;
        }
    }

}
