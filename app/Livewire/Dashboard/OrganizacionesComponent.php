<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class OrganizacionesComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $keyword;
    public $nombre, $email, $telefono, $web, $moneda, $dias, $formato, $proxima, $direccion, $representante;
    public $cerrarModal= true, $show = false;

    #[Locked]
    public $organizaciones_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $organizaciones = Organizacion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $total = Organizacion::buscar($this->keyword)->count();

        $rows = Organizacion::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        return view('livewire.dashboard.organizaciones-component')
            ->with('organizaciones', $organizaciones)
            ->with('rowsOrganizaciones', $rows)
            ->with('totalRows', $total);
    }

    public function setLimit()
    {
        if (numRowsPaginate() < $this->numero) {
            $rows = $this->numero;
        } else {
            $rows = numRowsPaginate();
        }
        $this->rows = $this->rows + $rows;
    }

    public function limpiar()
    {
        $this->reset([
            'nombre', 'email', 'telefono', 'web', 'moneda', 'dias', 'formato', 'proxima',
            'direccion', 'organizaciones_id', 'nuevo', 'editar', 'representante',
            'show', 'rowquid'
        ]);
        $this->resetErrorBag();
    }

    protected function rules()
    {
        return [
            'nombre' => ['required', 'min:4', Rule::unique('organizaciones', 'nombre')->ignore($this->organizaciones_id)],
            'email' => 'required|email',
            'telefono' => 'required',
            'web' => 'required',
            'moneda' => 'required',
            'dias' => 'required|integer|gt:0|max:28',
            //'formato' => 'required',
            'proxima' => 'nullable|integer|gt:0',
            'direccion' => 'required',
            'representante' => 'required'
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->organizaciones_id){
            //editar
            $organizacion = Organizacion::find($this->organizaciones_id);
        }else{
            //nuevo
            $organizacion = new Organizacion();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Organizacion::where('rowquid', $rowquid)->first();
            }while($existe);
            $organizacion->rowquid = $rowquid;
        }

        if ($organizacion){
            $organizacion->nombre = $this->nombre;
            $organizacion->email = $this->email;
            $organizacion->telefono = $this->telefono;
            $organizacion->web = $this->web;
            $organizacion->moneda = $this->moneda;
            $organizacion->dias_factura = $this->dias;
            $organizacion->formato_factura = $this->formato;
            if (!empty($this->proxima)){
                $organizacion->proxima_factura = $this->proxima;
            }else{
                $organizacion->proxima_factura = null;
            }
            $organizacion->direccion = $this->direccion;
            $organizacion->representante = $this->representante;
            $organizacion->save();

            if (!$this->organizaciones_id){
                $this->reset('keyword');
            }

            if ($this->cerrarModal){
                $this->limpiar();
                $this->dispatch('cerrarModal');
                Sleep::for(500)->millisecond();
                $this->toastBootstrap();
            }else{
                $this->showOrganizacion($organizacion->rowquid);
                $this->toastBootstrap();
            }
        }else{
            dispatch('cerrarModal');
        }
    }

    public function edit($rowquid, $cerrarModal = true)
    {
        $this->limpiar();
        $organizacion = $this->getOrganizaciones($rowquid);
        if ($organizacion){

            $this->nombre = $organizacion->nombre;
            $this->email = $organizacion->email;
            $this->telefono = $organizacion->telefono;
            $this->web = $organizacion->web;
            $this->moneda = $organizacion->moneda;
            $this->dias = $organizacion->dias_factura;
            $this->formato = $organizacion->formato_factura;
            $this->proxima = $organizacion->proxima_factura;
            $this->direccion = $organizacion->direccion;
            $this->representante = $organizacion->representante;
            $this->rowquid = $organizacion->rowquid;

            $this->nuevo = false;
            $this->editar = true;
            $this->organizaciones_id = $organizacion->id;

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            Sleep::for(500)->millisecond();
            $this->dispatch('cerrarModal');
        }
    }

    public function showOrganizacion($rowquid)
    {
        $this->edit($rowquid, false);
        $this->show = true;
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmed');
    }

    #[On('confirmed')]
    public function confirmed()
    {
        $organizacion = $this->getOrganizaciones($this->rowquid);
        if ($organizacion){
            $id = $organizacion->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $servicios = Servicio::where('organizaciones_id', $id)->first();
        if ($servicios){
            $vinculado = true;
        }

        $facturas = Factura::where('organizaciones_id', $id)->first();
        if ($facturas){
            $vinculado = true;
        }

        $planes = Plan::where('organizaciones_id', $id)->first();
        if ($planes){
            $vinculado = true;
        }



        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($organizacion){
                $nombre = "<b>".mb_strtoupper($organizacion->nombre)."</b>";
                $organizacion->nombre = "*".$organizacion->nombre;
                $organizacion->save();
                $organizacion->delete();
                $this->dispatch('cerrarModal');
                Sleep::for(500)->millisecond();
                $this->toastBootstrap('success', "Organización $nombre Eliminada.");
            }else{
                $this->dispatch('cerrarModal');
                $this->limpiar();
            }

        }

    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
    }

    public function cerrarBusqueda()
    {
        $this->reset('keyword');
        $this->limpiar();
    }

    protected function getOrganizaciones($rowquid): ?Organizacion
    {
        return Organizacion::where('rowquid', $rowquid)->first();
    }
}
