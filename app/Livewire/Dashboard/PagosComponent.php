<?php

namespace App\Livewire\Dashboard;


use App\Mail\ValidacionPagoMail;
use App\Models\Factura;
use App\Models\Pago;
use App\Traits\Facturas;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PagosComponent extends Component
{
    use ToastBootstrap;
    use MailBox;
    use Facturas;

    public $metodo = 'all';
    public $verMetodo, $verReferencia, $verBanco, $verMoneda, $verMonto, $verFecha, $classEstatus, $verEstatus, $verFactura, $verRowquid, $verCliente, $verTotal, $verBs;
    public $registrarPago = false;

    public $verObservacion;

    #[Locked]
    public $pagos_id, $rowquid, $estatus, $band;

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
            'registrarPago',
            'pagos_id', 'rowquid', 'estatus', 'band',
            'verObservacion',
        ]);
        $this->resetErrorBag();
    }

    public function btnRegistrarPago()
    {
        $this->dispatch('initRegistrarPago');
        $this->registrarPago = true;
    }

    public function show($rowquid, $initModal = true)
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
                if ($pago->facturas_id){
                    $alCambio = $pago->dollar * $pago->factura->factura_total;
                    $this->verBs = " / Bs ".formatoMillares($alCambio);
                }
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
            $this->verRowquid = $pago->facturas_id ? $pago->factura->rowquid : null;
            $this->verCliente = $pago->cliente->nombre." ".$pago->cliente->apellido;
            $this->verTotal = $pago->facturas_id ? $pago->factura->organizacion_moneda." ".formatoMillares($pago->factura->factura_total) : null;

            $this->estatus = $pago->estatus;
            $this->band = $pago->band;

            $this->verObservacion = $pago->observacion;

            if ($initModal){
                $this->dispatch('initModal');
            }

        }
    }

    public function btnVerPDF()
    {
        $this->showPdfFacturaTrait($this->verRowquid);
    }

    public function btnFiltro($key)
    {
        $this->metodo = $key;
    }

    #[On('initModal')]
    public function initModal()
    {
        //JS
    }

    #[On('delete')]
    public function delete()
    {
        $registro = Pago::find($this->pagos_id);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {

                $idFactura = $registro->facturas_id;

                $nombre = '<b class="text-uppercase text-warning">'.$registro->referencia.'</b>';
                $registro->referencia = "*".$registro->referencia;
                $registro->save();
                $registro->delete();

                if ($idFactura){
                    $factura = Factura::find($registro->facturas_id);
                    $factura->pagos_id = null;
                    $factura->save();
                }

                $this->dispatch('cerrarModalShowPago');
                $this->toastBootstrap('success', "Pago $nombre Eliminado.");
            }

        }

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

    #[On('btnCancelRegistrar')]
    public function btnCancelRegistrar()
    {
        $this->limpiar();
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

            $factura = Factura::find($pago->facturas_id);
            if ($estatus == 1){
                $factura->estatus = 1;
            }else{
                $factura->estatus = 0;
            }
            $factura->save();

            if ($estatus){
                $this->sendEmail($pago->id);
            }

            $this->show($this->rowquid, false);
        }
    }

    protected function sendEmail($id)
    {
        $pago = Pago::find($id);
        if ($pago) {
            $data = [
                'from_email' => getCorreoSistema(),
                'from_name' => config('app.name'),
                'subject' => 'Información sobre tu Pago',
                'estatus' => $pago->estatus,
                'cliente_nombre' => strtoupper($pago->cliente->nombre.' '.$pago->cliente->apellido),
                'factura_mes' => strtoupper(mesEspanol(getFecha($pago->factura->factura_fecha, "m"))),
                'factura_year' => getFecha($pago->factura->factura_fecha, "Y"),
                'pago_metodo' => getMetodoPago($pago->metodo),
                'pago_referencia' => strtoupper($pago->referencia),
                'pago_banco' => $pago->nombre,
                'pago_moneda' => $pago->moneda,
                'pago_monto' => formatoMillares($pago->monto),
                'pago_fecha' => getFecha($pago->fecha),
                'email' => getCorreoSistema(),
                'telefono' => getTelefonoSistema()
            ];
            $to = $pago->cliente->email;
            Mail::to($to)->send(new ValidacionPagoMail($data));
        }
    }

}
