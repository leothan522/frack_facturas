<?php

namespace App\Livewire\Dashboard;

use App\Traits\ToastBootstrap;
use Illuminate\Support\Sleep;
use Livewire\Attributes\On;
use Livewire\Component;

class PagosRegistrarComponent extends Component
{
    use ToastBootstrap;

    public $title = "Registrar Pago";
    public int $size = 305; //max-height: 305px;

    public function render()
    {
        return view('livewire.dashboard.pagos-registrar-component');
    }

    public function limpiar()
    {
        $this->reset([
            'title',
        ]);
        $this->reset();
    }

    #[On('initRegistrarPago')]
    public function initForm()
    {
        $this->limpiar();
        Sleep::for(5)->seconds();
    }
}
