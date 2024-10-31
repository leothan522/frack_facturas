<?php

namespace App\Livewire\Web;

use Livewire\Attributes\On;
use Livewire\Component;

class ConsultarComponent extends Component
{
    public function render()
    {
        return view('livewire.web.consultar-component');
    }

    #[On('cerrarSesion')]
    public function cerrarSesion()
    {
        session()->flush();
        $this->redirect('cliente');
    }
}
