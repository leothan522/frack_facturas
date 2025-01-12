<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Pago;
use App\Models\Parametro;
use App\Traits\Facturas;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class FacturasComponent extends Component
{
    use ToastBootstrap;
    use MailBox;
    use Facturas;

    public $idFacturarAutomatico, $facturarAutomatico, $nuevasFacturas = 0;
    public $verPDF, $send;

    #[Locked]
    public $rowquid;

    public function mount()
    {
        $this->getFacturarAutomatico();
    }

    public function render()
    {
        $listar = Factura::buscar($this->keyword)
            ->orderBy('factura_fecha', $this->order)
            ->paginate(15);
        $rows = Factura::buscar($this->keyword)->count();
        return view('livewire.dashboard.facturas-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function getFacturarAutomatico()
    {
        $this->reset(['idFacturarAutomatico', 'facturarAutomatico']);
        $parametro = Parametro::where('nombre', '=', 'facturar_automatico')->first();
        if ($parametro){
            $this->idFacturarAutomatico = $parametro->id;
            $this->facturarAutomatico = $parametro->valor;
        }
    }

    public function setFacturarAutomatico()
    {
        if (!$this->facturarAutomatico){
            $this->facturarAutomatico = 1;
        }else{
            $this->facturarAutomatico = 0;
        }

        if ($this->idFacturarAutomatico){
            //editar
            $parametro = Parametro::find($this->idFacturarAutomatico);
        }else{
            //nuevo
            $parametro = new Parametro();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }

        if ($parametro){
            $parametro->nombre = 'facturar_automatico';
            $parametro->valor = $this->facturarAutomatico;
            $parametro->save();
            $this->idFacturarAutomatico = $parametro->id;
        }

    }

    public function show($rowquid)
    {
        $this->reset(['send']);
        if ($this->verPDF){
            $path = Storage::exists('public/'.$this->verPDF);
            if ($path) {
                Storage::delete('public/'.$this->verPDF);
            }
            $this->reset(['verPDF']);
        }
        $factura = Factura::where('rowquid', $rowquid)->first();
        if ($factura) {
            $this->rowquid = $factura->rowquid;
            $this->send = $factura->send;
            $this->verPDF = $this->getPdfFacturaTrait($factura, 'save');
        }
    }

    #[On('delete')]
    public function delete()
    {
        $registro = Factura::where('rowquid', $this->rowquid)->first();
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
                $this->dispatch('confirmedDelete');
                $this->actualizar();
                $this->toastBootstrap('success', "Factura $nombre Eliminada.");
            }

        }
    }

    public function btnSendFactura()
    {
        $send = $this->sendFacturaTrait($this->rowquid);
        if ($send){
            $nombre = '<b class="text-uppercase text-warning">'.$this->facturaNumero.'</b>';
            $this->toastBootstrap('info', "Factura $nombre Enviada.");
        }
    }

    #[On('reeviarFactura')]
    public function btnReenviar()
    {
        $this->btnSendFactura();
    }

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        //JS
    }

}
