<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class ModalPdfComponent extends Component
{
    public $title = "Ver PDF", $codigo, $verPDF;

    public function render()
    {
        return view('livewire.dashboard.modal-pdf-component');
    }

    #[On('initModalVerPDF')]
    public function initModal($pdf, $title = null, $codigo = null)
    {
        $this->reset(['title', 'codigo', 'verPDF']);
        $this->show($pdf, $title, $codigo);
    }

    protected function show($pdf, $title = null, $codigo = null)
    {
        $this->verPDF = $pdf;
        if ($title){
            $this->title = $title;
        }
        if ($codigo){
            $this->codigo = $codigo;
        }
    }



}
