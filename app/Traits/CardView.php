<?php

namespace App\Traits;

use Livewire\Attributes\On;

trait CardView
{
    public $sizeFooter = 0; //60;
    public $modulo = "tabla", $form = false;
    public $ocultarTable = false, $ocultarCard = true;
    public $keyword, $btnNuevo = true, $btnCancelar = false, $confirmed = 'deleteNombre';

    public function limpiarCardView()
    {
        $this->reset([
            'form', 'btnNuevo', 'btnCancelar',
        ]);
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    public function cerrarBusqueda()
    {
        $this->reset(['keyword']);
    }

    public function actualizar()
    {
        //refresh
    }

    public function showHide($rowquid = null)
    {
        if ($rowquid){
            $this->ocultarTable = true;
            $this->ocultarCard = false;
            $this->show($rowquid);
        }else{
            $this->ocultarTable = false;
            $this->ocultarCard = true;
        }
    }

    public function createHide()
    {
        $this->ocultarTable = true;
        $this->ocultarCard = false;
        $this->create();
    }

    protected function setSizeFooter()
    {
        if ($this->ocultarTable){
            $this->sizeFooter = 63;
        }else{
            $this->sizeFooter = 0;
        }
    }

}
