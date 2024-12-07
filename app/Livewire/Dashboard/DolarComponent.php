<?php

namespace App\Livewire\Dashboard;

use App\Models\Parametro;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class DolarComponent extends Component
{

    use ToastBootstrap;

    public $monto = 1, $dolar_id;
    public $email, $email_id;
    public $telefono, $telefono_id;

    public function render()
    {
        $this->getDollar();
        $this->getEmail();
        $this->getTelefono();
        return view('livewire.dashboard.dolar-component');
    }

    public function save()
    {
        $rules = [
            'monto' => 'required'
        ];
        $this->validate($rules);

        if ($this->dolar_id){
            $parametro = Parametro::find($this->dolar_id);
        }else{
            $parametro = new Parametro();
            do {
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }

        if ($parametro){
            $parametro->nombre = "precio_dolar";
            $parametro->valor = $this->monto;
            $parametro->save();
            $this->dispatch('printDollar', dollar: formatoMillares($this->monto));
            $this->toastBootstrap('success', 'Dolar Actualizado.');
        }
    }

    protected function getDollar(): void
    {
        $this->reset(['monto', 'dolar_id']);
        $parametro = Parametro::where('nombre', 'precio_dolar')->first();
        if ($parametro){
            $this->dolar_id = $parametro->id;
            $this->monto = floatval($parametro->valor);
        }
    }

    #[On('initDollar')]
    public function initDollar()
    {
        //JS
    }

    #[On('verDollar')]
    public function verDollar()
    {
        $this->dispatch('printDollar', dollar: formatoMillares($this->monto));
    }

    #[On('printDollar')]
    public function printDollar($dollar)
    {
        //JS
    }

    #[On('initEmail')]
    public function initEmail()
    {
        //JS
    }

    protected function getEmail()
    {
        $this->reset(['email', 'email_id']);
        $parametro = Parametro::where('nombre', 'email_sistema')->first();
        if ($parametro){
            $this->email = $parametro->valor;
            $this->email_id = $parametro->id;
        }
    }

    public function printEmail($email)
    {
        //JS
    }

    public function saveEmail()
    {
        $rules = [
            'email' => 'required'
        ];
        $this->validate($rules);

        if ($this->email_id){
            $parametro = Parametro::find($this->email_id);
        }else{
            $parametro = new Parametro();
            do {
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }

        if ($parametro){
            $parametro->nombre = "email_sistema";
            $parametro->valor = $this->email;
            $parametro->save();
            $this->dispatch('printEmail', email: strtolower($this->email));
            $this->toastBootstrap('success', 'Email Actualizado.');
        }
    }

    #[On('verEmail')]
    public function verEmail()
    {
        $this->dispatch('printEmail', email: strtolower($this->email));
    }

    #[On('initTelefono')]
    public function initTelefono()
    {
        //JS
    }

    protected function getTelefono()
    {
        $this->reset(['telefono', 'telefono_id']);
        $parametro = Parametro::where('nombre', 'telefono_sistema')->first();
        if ($parametro){
            $this->telefono = $parametro->valor;
            $this->telefono_id = $parametro->id;
        }
    }

    public function printTelefono($telefono)
    {
        //JS
    }

    public function saveTelefono()
    {
        $rules = [
            'telefono' => 'required'
        ];
        $this->validate($rules);

        if ($this->telefono_id){
            $parametro = Parametro::find($this->telefono_id);
        }else{
            $parametro = new Parametro();
            do {
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }

        if ($parametro){
            $parametro->nombre = "telefono_sistema";
            $parametro->valor = $this->telefono;
            $parametro->save();
            $this->dispatch('printTelefono', telefono: $this->telefono);
            $this->toastBootstrap('success','Teléfono Actualizado.');
        }
    }

    #[On('verTelefono')]
    public function verTelefono()
    {
        $this->dispatch('printTelefono', telefono: $this->telefono);
    }

}
