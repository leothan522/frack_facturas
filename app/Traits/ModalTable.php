<?php

namespace App\Traits;

use Livewire\Attributes\Locked;

trait ModalTable
{
    public $ocultarTable = false, $ocultarCard = true, $btnNuevo = true,  $keyword;
    public $modalTitle = "Tipos", $min = 350, $confirmed = 'deleteTipos', $modulo = "tipos";

    #[Locked]
    public $tabla_id, $rowquid;

    protected function limpiarModal()
    {
        $this->reset([
            'ocultarTable', 'ocultarCard', 'btnNuevo',
            'tabla_id',
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->limpiar();
        $this->ocultarTable = true;
        $this->ocultarCard = false;
        $this->btnNuevo = false;
    }

    public function cancel()
    {
        $this->limpiar();
    }

    public function buscar()
    {
        $this->limpiar();
        //$this->keyword = $keyword;
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
    }

    public function actualizar()
    {
        //refresh
    }

}
