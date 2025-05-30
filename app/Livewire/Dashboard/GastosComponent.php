<?php

namespace App\Livewire\Dashboard;

use App\Models\Gasto;
use App\Models\Moneda;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class GastosComponent extends Component
{
    use ToastBootstrap;
    use MailBox;

    public $registrar = false;
    public $title = "Registrar Gasto";
    public $listarMonedas = [];
    public $filtro = 'all', $desde, $hasta;
    public $fecha, $concepto, $moneda, $monto, $descripcion;
    public $verFecha, $verConcepto, $verMoneda, $verMonto, $verDescripcion;

    public function render()
    {
        $listar = Gasto::buscar($this->keyword)
            ->orderBy('fecha', $this->order)
            ->paginate(numRowsPaginate());
        $rows = Gasto::buscar($this->keyword)->count();

        return view('livewire.dashboard.gastos-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar(): void
    {
        $this->reset([
            'registrar', 'size',
            'fecha', 'concepto', 'moneda', 'monto', 'descripcion',
            'verFecha', 'verConcepto', 'verMoneda', 'verMonto', 'verDescripcion'
        ]);
        $this->resetErrorBag();
    }

    public function show($rowquid, $initModal = true)
    {
        if ($initModal){
            $this->dispatch('initModal');
        }
    }

    public function btnRegistrar(): void
    {
        $this->listarMonedas = Moneda::all();
        $this->size = 251;
        $this->dispatch('initRegistrar');
        $this->registrar = true;
    }

    #[On('btnCancelRegistrar')]
    public function btnCancelRegistrar(): void
    {
        $this->limpiar();
    }

    #[On('initReporte')]
    public function initReporte()
    {
        $this->reset(['filtro', 'desde', 'hasta']);
        $this->resetErrorBag();
        $this->listarMonedas = Moneda::all();
    }

    #[On('initModal')]
    public function initModal()
    {
        //JS
    }

}
