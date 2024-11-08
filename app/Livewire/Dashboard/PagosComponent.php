<?php

namespace App\Livewire\Dashboard;

use App\Models\Pago;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PagosComponent extends Component
{
    use LivewireAlert;
    use WithPagination, WithoutUrlPagination;

    public $view = 'show',$order = 'DESC', $keyword;
    public $rows;
    public $titleModal = "Ver Pago", $display = "verPago";
    public $verMetodo, $referencia, $banco, $fecha, $estatus = 0, $verEstatus, $moneda, $monto;
    public $factura_numero, $factura_cliente, $factura_etiqueta, $factura_fecha, $factura_total, $factura_rowquid = 'null';
    public array $filtro = [
        'transferencia' => 'Tranferencias',
        'movil' => 'Pago Móvil',
        'zelle' => 'Zelle',
        'all'   => 'Todos'
    ];
    public $tipo = 'all';
    public array $icono = [
        0 => '<i class="fas fa-exclamation-circle text-primary"></i>',
        1 => '<i class="fas fa-check-circle text-success"></i>',
        2 => '<i class="fas fa-exclamation-triangle text-danger"></i>',
    ];

    #[Locked]
    public $pagos_id, $rowquid;

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
            'titleModal', 'display',
            'verMetodo', 'referencia', 'banco', 'fecha', 'estatus', 'verEstatus', 'moneda', 'monto',
            'factura_numero', 'factura_cliente', 'factura_etiqueta', 'factura_fecha', 'factura_total', 'factura_rowquid',
            'pagos_id', 'rowquid'
        ]);

        $this->resetErrorBag();
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $pago = $this->getPago($rowquid);
        if ($pago) {

            $this->pagos_id = $pago->id;
            $this->verMetodo = $this->filtro[$pago->metodo];
            $this->referencia = $pago->referencia;

            if ($pago->metodo != "zelle"){
                $this->banco = $pago->nombre;
            }

            $this->moneda = $pago->moneda;
            $this->monto = $pago->monto;
            $this->fecha = $pago->fecha;

            if ($pago->estatus == 0){
                $this->estatus = 0;
                $this->verEstatus = "Esperando Validación";
            }
            if ($pago->estatus == 1){
                $this->estatus = 1;
                $this->verEstatus = "Validado";
            }
            if ($pago->estatus == 2){
                $this->estatus = 2;
                $this->verEstatus = "NO Validado (Revisar)";
            }

            $this->factura_numero = $pago->factura->factura_numero;
            $this->factura_cliente = $pago->factura->cliente_nombre ." ". $pago->factura->cliente_apellido;
            $this->factura_etiqueta = $pago->factura->plan_etiqueta;
            $this->factura_fecha = $pago->factura->factura_fecha;
            $this->factura_total = $pago->factura->factura_total;
            $this->factura_rowquid = $pago->factura->rowquid;

        }else{
            $this->dispatch('cerrarModal');
        }
    }

    public function btnProcesar()
    {
        $this->view = "procesar";
    }

    public function btnMasTarde()
    {
        $this->view = "show";
    }

    public function btnSI()
    {
        $pago = Pago::find($this->pagos_id);
        $pago->estatus = 1;
        $pago->save();
        $this->show($pago->rowquid);
        $this->alert('success', 'Datos Guardados.');
    }

    public function btnNO()
    {
        $pago = Pago::find($this->pagos_id);
        $pago->estatus = 2;
        $pago->save();
        $this->show($pago->rowquid);
        $this->alert('success', 'Datos Guardados.');
    }

    public function btnReset()
    {
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => '¡Sí, restablacer!',
            'text' => '¡Si restableces el pago, su estatus cambiara a Esperando Validación!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'resetPago',
        ]);
    }

    #[On('resetPago')]
    public function resetPago()
    {
        $pago = Pago::find($this->pagos_id);
        $pago->estatus = 0;
        $pago->save();
        $this->show($pago->rowquid);
        $this->alert('info', 'Pago Reestablecido.');
    }

    protected function getPago($rowquid): ?Pago
    {
        return Pago::where('rowquid', $rowquid)->first();
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

    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
    }

}
