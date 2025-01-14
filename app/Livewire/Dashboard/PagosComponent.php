<?php

namespace App\Livewire\Dashboard;


use App\Models\Pago;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PagosComponent extends Component
{
    use ToastBootstrap;
    use MailBox;

    public $metodo = 'all';
    public $verMetodo, $verReferencia, $verBanco, $verMoneda, $verMonto, $verFecha, $classEstatus, $verEstatus, $verFactura, $verRowquid, $verCliente, $verTotal, $verBs;

    #[Locked]
    public $pagos_id, $rowquid, $estatus;

    public function render()
    {
        if ($this->metodo == 'all'){
            $listar = Pago::buscar($this->keyword)
                ->orderBy('fecha', $this->order)
                ->paginate(numRowsPaginate());
            $rows = Pago::buscar($this->keyword)->count();
        }else{
            $listar = Pago::buscar($this->keyword)
                ->where('metodo', $this->metodo)
                ->orderBy('fecha', $this->order)
                ->paginate(numRowsPaginate());
            $rows = Pago::buscar($this->keyword)->where('metodo', $this->metodo)->count();
        }

        return view('livewire.dashboard.pagos-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->reset([
            'verMetodo', 'verReferencia', 'verBanco', 'verMoneda', 'verMonto', 'verFecha', 'classEstatus', 'verEstatus', 'verFactura', 'verRowquid', 'verCliente', 'verTotal', 'verBs',
            'pagos_id', 'rowquid', 'estatus'
        ]);
        $this->resetErrorBag();
    }

    public function show($rowquid)
    {
        $this->limpiar();
        $pago = Pago::where('rowquid', $rowquid)->first();
        if ($pago){

            $this->pagos_id = $pago->id;
            $this->rowquid = $pago->rowquid;

            $this->verMetodo = getMetodoPago($pago->metodo);
            $this->verReferencia = $pago->referencia;
            if ($pago->metodo != "zelle"){
                $this->verBanco = $pago->nombre;
                $alCambio = $pago->dollar * $pago->factura->factura_total;
                $this->verBs = " / Bs ".formatoMillares($alCambio);
            }
            $this->verMoneda = $pago->moneda;
            $this->verMonto = formatoMillares($pago->monto);
            $this->verFecha = getFecha($pago->fecha);
            if ($pago->estatus == 0){
                $this->classEstatus = 'text-primary';
                $this->verEstatus = $this->icono[$pago->estatus]." Esperando Validación";
            }
            if ($pago->estatus == 1){
                $this->classEstatus = 'text-success';
                $this->verEstatus = $this->icono[$pago->estatus]." Validado";
            }
            if ($pago->estatus == 2){
                $this->classEstatus = 'text-danger';
                $this->verEstatus = $this->icono[$pago->estatus]." NO Validado (Revisar)";
            }
            $this->verFactura = $pago->factura_numero;
            $this->verRowquid = $pago->factura->rowquid;
            $this->verCliente = $pago->cliente->nombre." ".$pago->cliente->apellido;
            $this->verTotal = $pago->factura->organizacion_moneda." ".formatoMillares($pago->factura->factura_total);

            $this->estatus = $pago->estatus;

        }else{
            Sleep::for(250)->milliseconds();
            $this->dispatch('cerrarModalShowPago');
        }
    }

    public function btnFiltro($key)
    {
        $this->metodo = $key;
    }

    #[On('btnResetPago')]
    public function btnReset()
    {
        $this->setEstatusPago(0);
    }

    #[On('btnRechazarPago')]
    public function btnRechazar()
    {
        $this->setEstatusPago(2);
    }

    #[On('btnAprobarPago')]
    public function btnAprobar()
    {
        $this->setEstatusPago(1);
    }

    #[On('cerrarModalShowPago')]
    public function cerrarModal()
    {
        //JS
    }

    protected function setEstatusPago($estatus)
    {
        $pago = Pago::find($this->pagos_id);
        if ($pago){
            $pago->estatus = $estatus;
            $pago->save();
            $this->show($this->rowquid);
        }
    }


    public function btnVerPDF()
    {
        $this->dispatch('initModalVerPDF', pdf: $this->verPDF, title: 'Factura', codigo: $this->facturaNumero);
    }


}
