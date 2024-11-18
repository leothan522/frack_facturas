<?php

namespace App\Livewire\Dashboard;

use App\Models\Parametro;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class DolarComponent extends Component
{

    use LivewireAlert;

    public $monto = 1, $dolar_id;
    public $email, $email_id;

    public function render()
    {
        $this->getDollar();
        $this->getEmail();
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
        }

        if ($parametro){
            $parametro->nombre = "precio_dolar";
            $parametro->valor = $this->monto;
            $parametro->save();
            $this->dispatch('printDollar', dollar: formatoMillares($this->monto));
            $this->alert('success', "Dolar Actualizado.");
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
        }

        if ($parametro){
            $parametro->nombre = "email_sistema";
            $parametro->valor = $this->email;
            $parametro->save();
            $this->dispatch('printEmail', email: strtolower($this->email));
            $this->alert('success', "Email Actualizado.");
        }
    }

    #[On('verEmail')]
    public function verEmail()
    {
        $this->dispatch('printEmail', email: strtolower($this->email));
    }

}
