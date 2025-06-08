<?php

namespace App\Livewire\Dashboard;

use App\Exports\FacturasExport;
use App\Models\Factura;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class FacturasReportesComponent extends Component
{
    use ToastBootstrap;

    public $filtro = 'all', $desde, $hasta;

    public function render()
    {
        return view('livewire.dashboard.facturas-reportes-component');
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
            $facturas = Factura::whereBetween('factura_fecha', [$this->desde, $this->hasta])->orderBy('factura_fecha')->get();
        }else{
            if ($this->filtro == 1){
                $name = "Con_Pagos";
            }else{
                $name = "Sin_Pagos";
            }
            $facturas = Factura::whereBetween('factura_fecha', [$this->desde, $this->hasta])->where('estatus', $this->filtro)->orderBy('factura_fecha')->get();
        }

        if ($facturas->isNotEmpty()){
            $this->toastBootstrap('info', 'Descarga Iniciada.');
            return Excel::download(new FacturasExport($facturas), "Facturas_$name.xlsx");
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
                            No existen facturas registradas entre el rango de fechas que has indicado.
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
