<?php

namespace App\Traits;

use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

trait MailBox
{
    use WithPagination, WithoutUrlPagination;

    public $size = 340;
    public $order = 'DESC';
    public $keyword;

    public array $icono = [
        0 => '<i class="fas fa-exclamation-circle text-primary"></i>',
        1 => '<i class="fas fa-check-circle text-success"></i>',
        2 => '<i class="fas fa-exclamation-triangle text-danger"></i>',
    ];

    public function orderAscending(){
        $this->order = 'ASC';
    }

    public function orderDescending(){
        $this->order = 'DESC';
    }

    public function buscar()
    {
        $this->resetPage();
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
        $this->resetPage();
    }

    public function actualizar()
    {
        //refresh
    }

}
