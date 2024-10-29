<?php

namespace App\Livewire\Dashboard;

use App\Models\Banco;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class MetodosComponent extends Component
{
    use LivewireAlert;

    public $view = "show", $classTransferencia = 'card-danger', $classPagoMovil = 'card-danger', $classZelle = 'card-danger';
    public $bancoTransferencia, $bancoPagoMovil;
    public $metodo, $titular, $cuenta, $tipo, $prefijo = 'V-', $numero, $cedula, $telefono, $email;

    #[Locked]
    public $metodos_id, $rowquid;

    public function render()
    {
        return view('livewire.dashboard.metodos-component');
    }

    public function limpiar()
    {
        $this->reset([
            'view',
            'bancoTransferencia', 'bancoPagoMovil',
            'metodo', 'titular', 'cuenta', 'tipo', 'cedula', 'telefono', 'email',
            'metodos_id', 'rowquid'
        ]);
        $this->resetErrorBag();
    }

    public function irTransferencia()
    {
        $this->limpiar();
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initBancoTranferencia', data: $data);
        $this->view = "transferencia";
    }

    public function irPagoMovil()
    {
        $this->limpiar();
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initBancoPagoMovil', data: $data);
        $this->view = "pago-movil";
    }

    public function irZelle(){
        $this->limpiar();
        $this->view = "zelle";
    }

    #[On('initBancoTranferencia')]
    public function initBancoTranferencia($data)
    {
        //JS
    }

    #[On('getBancoTransferencia')]
    public function getBancoTransferencia($rowquid)
    {
        $this->bancoTransferencia = $rowquid;
    }

    #[On('setBancoTransferencia')]
    public function setBancoTransferencia($rowquid)
    {
        //JS
    }

    #[On('initBancoPagoMovil')]
    public function initBancoPagoMovil($data)
    {
        //JS
    }

    #[On('getBancoPagoMovil')]
    public function getBancoPagoMovil($rowquid)
    {
        $this->bancoPagoMovil = $rowquid;
    }

    #[On('setBancoPagoMovil')]
    public function setBancoPagoMovil($rowquid)
    {
        //JS
    }





}
