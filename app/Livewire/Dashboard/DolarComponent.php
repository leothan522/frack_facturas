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

    public function render()
    {
        $this->getDollar();
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

}
