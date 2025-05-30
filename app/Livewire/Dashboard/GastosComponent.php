<?php

namespace App\Livewire\Dashboard;

use App\Exports\GastosExport;
use App\Models\Gasto;
use App\Models\Moneda;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

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

    #[Locked]
    public $gastos_id;

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
            'verFecha', 'verConcepto', 'verMoneda', 'verMonto', 'verDescripcion',
            'gastos_id'
        ]);
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $rules = [
            'fecha' => 'required',
            'concepto' => 'required',
            'moneda' => 'required',
            'monto' => 'required',
            'descripcion' => 'required'
        ];
        $messages = [
            'descripcion.required' => 'El campo observación es obligatorio.'
        ];
        $this->validate($rules, $messages);

        if ($this->gastos_id){
            $gasto = Gasto::find($this->gastos_id);
        }else{
            $gasto = new Gasto();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Gasto::where('rowquid', $rowquid)->first();
            }while($existe);
            $gasto->rowquid = $rowquid;
        }

        $gasto->fecha = $this->fecha;
        $gasto->concepto = $this->concepto;
        $gasto->monto = $this->monto;
        $gasto->moneda = $this->moneda;
        if ($this->descripcion){
            $gasto->descripcion = $this->descripcion;
        }
        $gasto->save();
        $this->limpiar();
        $this->toastBootstrap();
    }

    public function show($rowquid): void
    {
        $gasto = Gasto::where('rowquid', $rowquid)->first();
        if ($gasto){
            $this->gastos_id = $gasto->id;
            $this->verFecha = getFecha($gasto->fecha);
            $this->verConcepto = $gasto->concepto;
            $this->verMoneda = $gasto->moneda;
            $this->verMonto = formatoMillares($gasto->monto);
            $this->verDescripcion = $gasto->descripcion;
            $this->dispatch('initModal');
        }
    }

    public function edit()
    {
        $gasto = Gasto::find($this->gastos_id);
        if ($gasto){
            $this->fecha = $gasto->fecha;
            $this->concepto = $gasto->concepto;
            $this->moneda = $gasto->moneda;
            $this->monto = $gasto->monto;
            $this->descripcion = $gasto->descripcion;
            $this->btnRegistrar();
        }
    }

    #[On('delete')]
    public function delete()
    {
        $gasto = Gasto::find($this->gastos_id);
        if ($gasto){
            $gasto->delete();
            $this->limpiar();
            $this->dispatch('cerrarModal');
        }
    }

    public function generarReporte()
    {
        $rules = [
            'desde' => 'required',
            'hasta' => 'required|after_or_equal:desde',
        ];
        $this->validate($rules);

        if ($this->filtro == 'all'){
            $name = "Todos";
            $pagos = Gasto::whereBetween('fecha', [$this->desde, $this->hasta])->orderBy('fecha')->get();
        }else{
            $name = ucfirst($this->filtro);
            $pagos = Gasto::whereBetween('fecha', [$this->desde, $this->hasta])->where('moneda', $this->filtro)->orderBy('fecha')->get();
        }

        $this->toastBootstrap('info', 'Descarga Iniciada.');
        return Excel::download(new GastosExport($pagos), "Gastos_$name.xlsx");
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
    public function initReporte(): void
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

    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
    }

}
