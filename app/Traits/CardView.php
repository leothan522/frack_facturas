<?php

namespace App\Traits;

use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

trait CardView
{
    public $sizeFooter = 0; //55;
    public $title = 'texto', $modulo = "tabla", $form = false;
    public $ocultarTable = false, $ocultarCard = true;
    public $keyword, $btnNuevo = true, $btnCancelar = false, $confirmed = 'delete';

    #[Locked]
    public $table_id, $rowquid;

    public function limpiarCardView()
    {
        $this->reset([
            'table_id', 'form', 'btnNuevo', 'btnCancelar',
        ]);
        $this->setTitle();
    }

    public function create()
    {
        $this->limpiar();
        $this->setTitle('create');
        $this->btnNuevo = false;
        $this->btnCancelar = true;
        $this->form = true;
        $this->setSizeFooter();
    }

    public function edit()
    {
        $this->setTitle('edit');
        $this->btnNuevo = true;
        $this->btnCancelar = true;
        $this->form = true;
        $this->setSizeFooter();
    }

    public function cancel()
    {
        if ($this->rowquid){
            $this->show($this->rowquid);
        }else{
            $this->create();
        }
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

    protected function setTitle($option = null)
    {
        $this->title = match ($option) {
            'create' => "Crear ".$this->texto,
            'edit' => "Editar ".$this->texto,
            default => "Ver ". $this->texto,
        };

    }

    protected function setSizeFooter()
    {
        if ($this->form) {
            $this->sizeFooter = 55;
        }else{
            $this->sizeFooter = 0;
        }
    }

}
