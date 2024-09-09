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

class PlanesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $keyword;
    public $nombre, $bajada, $subida, $precio, $organizaciones_id, $etiqueta, $organizacion;
    public $cerrarModal= true, $show = false;

    #[Locked]
    public $planes_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $planes = Plan::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $total = Plan::buscar($this->keyword)->count();

        $rows = Plan::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        $organizaciones = Organizacion::orderBy('nombre', 'ASC')->get();

        return view('livewire.dashboard.planes-component')
            ->with('planes', $planes)
            ->with('rowsPlanes', $rows)
            ->with('organizaciones', $organizaciones)
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
            'nombre', 'bajada', 'subida', 'precio', 'organizaciones_id', 'planes_id', 'etiqueta',
            'nuevo', 'editar', 'organizacion',
            'show', 'rowquid'
        ]);
        $this->resetErrorBag();
    }

    protected function rules()
    {
        return [
            'nombre' => 'required|min:3',
            'etiqueta' => 'required|min:3',
            'bajada' => 'required|integer|gt:0',
            'subida' => 'required|integer|gt:0',
            'precio' => 'required|numeric|gt:0',
            'organizaciones_id' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->planes_id){
            //editar
            $plan = Plan::find($this->planes_id);
        }else{
            //nuevo
            $plan = new Plan();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Plan::where('rowquid', $rowquid)->first();
            }while($existe);
            $plan->rowquid = $rowquid;
        }

        if ($plan){
            $plan->nombre = $this->nombre;
            $plan->etiqueta_factura = $this->etiqueta;
            $plan->bajada = $this->bajada;
            $plan->subida = $this->subida;
            $plan->precio = $this->precio;
            $organizacion = $this->getOrganizacion($this->organizaciones_id);
            $plan->organizaciones_id = $organizacion->id;
            $plan->save();

            $this->alert('success', 'Datos Guardados.');

            if (!$this->planes_id){
                $this->reset('keyword');
            }

            if ($this->cerrarModal){
                $this->limpiar();
                $this->dispatch('cerrarModal');
            }else{
                $this->showPlan($plan->rowquid);
            }
        }else{
            $this->dispatch('cerrarModal');
        }
    }

    public function edit($rowquid, $cerrarModal = true)
    {
        $this->limpiar();
        $plan = $this->getPlan($rowquid);
        if ($plan){

            $this->nombre = $plan->nombre;
            $this->etiqueta = $plan->etiqueta_factura;
            $this->bajada = $plan->bajada;
            $this->subida = $plan->subida;
            $this->precio = $plan->precio;
            $organizacion = Organizacion::find($plan->organizaciones_id);
            $this->organizaciones_id = $organizacion->rowquid;
            $this->organizacion = $plan->organizacion->nombre;
            $this->rowquid = $plan->rowquid;

            $this->nuevo = false;
            $this->editar = true;
            $this->planes_id = $plan->id;

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            Sleep::for(500)->millisecond();
            $this->dispatch('cerrarModal');
        }
    }

    public function showPlan($rowquid)
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
        $id = null;
        $plan = $this->getPlan($this->rowquid);
        if ($plan){
            $id = $plan->id;
        }

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $servicios = Servicio::where('planes_id', $id)->first();
        if ($servicios){
            $vinculado = true;
        }

        $facturas = Factura::where('planes_id', $id)->first();
        if ($facturas){
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
            if ($plan){
                $plan->delete();
                $this->alert('success', 'Plan Eliminado.');
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

    protected function getPlan($rowquid): ?Plan
    {
        return Plan::where('rowquid', $rowquid)->first();
    }

    protected function getOrganizacion($rowquid): ?Organizacion
    {
        return Organizacion::where('rowquid', $rowquid)->first();
    }

}
