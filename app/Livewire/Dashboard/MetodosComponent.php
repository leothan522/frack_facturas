<?php

namespace App\Livewire\Dashboard;

use App\Models\Banco;
use App\Models\Metodo;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class MetodosComponent extends Component
{
    use ToastBootstrap;

    public $size = 179;
    public $view = "show", $classTransferencia = 'card-danger', $classPagoMovil = 'card-danger', $classZelle = 'card-danger';
    public $bancoTransferencia, $bancoPagoMovil;
    public $metodo, $titular, $cuenta, $tipo, $prefijo = 'V-', $numero, $cedula, $telefono, $email;

    #[Locked]
    public $metodos_id, $rowquid;

    public function mount()
    {
        $this->getDatosTransferencia();
        $this->getDatosPagoMovil();
        $this->getDatosZelle();
    }

    public function render()
    {
        return view('livewire.dashboard.metodos-component');
    }

    public function limpiar()
    {
        $this->reset([
            'view', 'size',
            'bancoTransferencia', 'bancoPagoMovil',
            'metodo', 'titular', 'cuenta', 'tipo', 'prefijo', 'numero','cedula', 'telefono', 'email',
            'metodos_id', 'rowquid'
        ]);
        $this->resetErrorBag();
    }

    public function irTransferencia()
    {
        $this->limpiar();
        $this->size = 248;
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initBancoTranferencia', data: $data);
        $this->getDatosTransferencia();
        $this->metodo = "transferencia";
        $this->view = "transferencia";
    }

    public function irPagoMovil()
    {
        $this->limpiar();
        $this->size = 248;
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initBancoPagoMovil', data: $data);
        $this->getDatosPagoMovil();
        $this->metodo = "movil";
        $this->view = "pago-movil";
    }

    public function irZelle(){
        $this->limpiar();
        $this->size = 248;
        $this->getDatosZelle();
        $this->metodo = "zelle";
        $this->view = "zelle";
    }

    public function saveTransferencia()
    {
        $rules = [
            'titular' => 'required',
            'cuenta' => 'required|numeric|digits:20',
            'numero' => 'required|integer|min_digits:6',
            'tipo' => 'required',
            'bancoTransferencia' => 'required',
        ];

        $messages = [
            'bancoTransferencia.required' => 'El campo banco es obligatorio.',
        ];;

        $this->validate($rules, $messages);

        if ($this->metodos_id){
            $metodo = Metodo::find($this->metodos_id);
        }else{
            $metodo = new Metodo();
        }

        if ($metodo){
            $metodo->metodo = $this->metodo;
            $metodo->titular = $this->titular;
            $metodo->cuenta = $this->cuenta;
            $metodo->cedula = $this->prefijo . $this->numero;
            $metodo->tipo = $this->tipo;
            $metodo->bancos_id = $this->bancoTransferencia;
            $metodo->save();
            $this->classTransferencia = 'card-success';
            $this->limpiar();
            $this->toastBootstrap();
        }

    }

    public function savePagoMovil()
    {
        $rules = [
            'telefono' => 'required|numeric|min_digits:10',
            'numero' => 'required|integer|min_digits:6',
            'bancoPagoMovil' => 'required',
        ];

        $messages = [
            'bancoPagoMovil.required' => 'El campo banco es obligatorio.',
        ];;

        $this->validate($rules, $messages);

        if ($this->metodos_id){
            $metodo = Metodo::find($this->metodos_id);
        }else{
            $metodo = new Metodo();
        }

        if ($metodo){
            $metodo->metodo = $this->metodo;
            $metodo->telefono = $this->telefono;
            $metodo->cedula = $this->prefijo . $this->numero;
            $metodo->bancos_id = $this->bancoPagoMovil;
            $metodo->save();
            $this->classPagoMovil = 'card-success';
            $this->limpiar();
            $this->toastBootstrap();
        }

    }

    public function saveZelle()
    {
        $rules = [
            'titular' => 'required',
            'email' => 'required|email:rfc,dns',
        ];

        $messages = [
            'bancoPagoMovil.required' => 'El campo banco es obligatorio.',
        ];;

        $this->validate($rules, $messages);

        if ($this->metodos_id){
            $metodo = Metodo::find($this->metodos_id);
        }else{
            $metodo = new Metodo();
        }

        if ($metodo){
            $metodo->metodo = $this->metodo;
            $metodo->titular = $this->titular;
            $metodo->email = $this->email;
            $metodo->save();
            $this->classZelle = 'card-success';
            $this->limpiar();
            $this->toastBootstrap();
        }

    }

    protected function getDatosTransferencia()
    {
        $metodo = Metodo::where('metodo', 'transferencia')->first();
        if ($metodo){
            $this->classTransferencia = 'card-success';
            $this->titular = $metodo->titular;
            $this->cuenta = $metodo->cuenta;
            $explode = explode('-', $metodo->cedula);
            $this->prefijo = $explode[0]."-";
            $this->numero = $explode[1];
            $this->tipo = $metodo->tipo;
            $this->metodos_id = $metodo->id;
            $this->dispatch('setBancoTransferencia', rowquid: $metodo->bancos_id);
        }else{
            $this->classTransferencia = 'card-danger';
        }
    }

    protected function getDatosPagoMovil()
    {
        $metodo = Metodo::where('metodo', 'movil')->first();
        if ($metodo){
            $this->classPagoMovil = 'card-success';
            $this->telefono = $metodo->telefono;
            $explode = explode('-', $metodo->cedula);
            $this->prefijo = $explode[0]."-";
            $this->numero = $explode[1];
            $this->metodos_id = $metodo->id;
            $this->dispatch('setBancoPagoMovil', rowquid: $metodo->bancos_id);
        }else{
            $this->classPagoMovil = 'card-danger';
        }
    }

    protected function getDatosZelle()
    {
        $metodo = Metodo::where('metodo', 'zelle')->first();
        if ($metodo){
            $this->classZelle = 'card-success';
            $this->titular = $metodo->titular;
            $this->email = $metodo->email;
            $this->metodos_id = $metodo->id;
        }else{
            $this->classZelle = 'card-danger';
        }
    }

    #[On('delete')]
    public function delete()
    {
        $metodo = Metodo::find($this->metodos_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($metodo){
                $metodo->delete();
                $this->getDatosTransferencia();
                $this->getDatosPagoMovil();
                $this->getDatosZelle();
                $this->toastBootstrap();
            }
            $this->limpiar();
        }

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
