<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Pago;
use App\Models\Servicio;
use App\Traits\Facturas;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientesFacturasComponent extends Component
{
    use ToastBootstrap;
    use Facturas;

    public $title =  "Facturas Cliente";
    public $listar;

    #[Locked]
    public $clientes_id, $servicios_id;

    public function render()
    {
        return view('livewire.dashboard.clientes-facturas-component');
    }

    public function limpiar()
    {
        $this->reset([
            'title',
            'listar',
        ]);
        $this->resetErrorBag();
    }

    #[On('initFacturasCliente')]
    public function initModal($id)
    {
        $this->limpiar();
        $this->clientes_id = $id;
        $this->listar = Factura::where('clientes_id', $this->clientes_id)
            ->limit(13)
            ->orderBy('factura_fecha', 'DESC')
            ->get();

        $servicio = Servicio::where('clientes_id', $this->clientes_id)->first();
        if ($servicio){
            $this->servicios_id = $servicio->id;
        }

    }

    #[On('cerrarModalFacturasCliente')]
    public function cerrarModal()
    {
        //JS
    }

    public function btnGenerarFactura()
    {
        $factura = $this->createFacturaTrait($this->servicios_id);
        if ($factura){
            $this->initModal($this->clientes_id);
            $this->toastBootstrap('info', 'Factura Generada.');
        }else{
            $this->confirmToastBootstrap(null, null, [
                'type' => 'warning',
                'title' => "¡No se puede Generar la Factura!",
                'message' => 'Aún no se ha alcanzado la fecha de pago del cliente para la proxima factura.'
            ]);
        }
    }

    #[On('deleteFacturaCliente')]
    public function delete($rowquid)
    {
        $registro = Factura::where('rowquid', $rowquid)->first();
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $pagos = Pago::where('facturas_id', $registro->id)->first();
            if ($pagos){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->factura_numero.'</b>';
                $registro->delete();
                $this->initModal($this->clientes_id);
                $this->toastBootstrap('success', "Factura $nombre Eliminada.");
            }

        }
    }

    public function btnSendFactura($rowquid)
    {
        $send = $this->sendFacturaTrait($rowquid);
        if ($send){
            $this->initModal($this->clientes_id);
            $nombre = '<b class="text-uppercase text-warning">'.$this->facturaNumero.'</b>';
            $this->toastBootstrap('info', "Factura $nombre Enviada.");
        }
    }

    #[On('reeviarFacturaCliente')]
    public function btnReenviar($rowquid)
    {
        $this->btnSendFactura($rowquid);
    }

    public function btnVerPDF($rowquid)
    {
        $this->showPdfFacturaTrait($rowquid);
    }

}
