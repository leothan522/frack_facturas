<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class OrganizacionesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $keyword;
    public $nombre, $email, $telefono, $web, $moneda, $dias, $formato, $proxima, $direccion;
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
            'direccion', 'organizaciones_id', 'nuevo', 'editar',
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
            'dias' => 'required|integer|gt:0',
            'formato' => 'required',
            'proxima' => 'required|integer|gt:0',
            'direccion' => 'required',
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
            $organizacion->proxima_factura = $this->proxima;
            $organizacion->direccion = $this->direccion;
            $organizacion->save();

            $this->alert('success', 'Datos Guardados.');

            if (!$this->organizaciones_id){
                $this->reset('keyword');
            }

            if ($this->cerrarModal){
                $this->limpiar();
                $this->dispatch('cerrarModal');
            }else{
                $this->showOrganizacion($organizacion->id);
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
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => '¡Sí, bórralo!',
            'text' => '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);
    }

    #[On('confirmed')]
    public function confirmed()
    {
        $organizacion = $this->getOrganizaciones($this->rowquid);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $servicios = Servicio::where('organizaciones_id', $this->organizaciones_id)->first();
        if ($servicios){
            $vinculado = true;
        }

        $facturas = Factura::where('organizaciones_id', $this->organizaciones_id)->first();
        if ($facturas){
            $vinculado = true;
        }

        $planes = Plan::where('organizaciones_id', $this->organizaciones_id)->first();
        if ($planes){
            $vinculado = true;
        }



        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            if ($organizacion){
                $organizacion->nombre = "*".$organizacion->nombre;
                $organizacion->save();
                $organizacion->delete();
                $this->alert('success', 'Organización Eliminada.');
            }
            $this->dispatch('cerrarModal');
            $this->limpiar();
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
