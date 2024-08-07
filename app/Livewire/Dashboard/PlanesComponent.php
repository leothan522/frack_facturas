<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PlanesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $planes_id, $keyword;
    public $nombre, $bajada, $subida, $precio, $organizaciones_id, $etiqueta, $organizacion;
    public $cerrarModal= true, $show = false;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $planes = Plan::buscar($this->keyword)
            ->orderBy('updated_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $rows = Plan::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        $organizaciones = Organizacion::orderBy('nombre', 'ASC')->get();

        return view('livewire.dashboard.planes-component')
            ->with('planes', $planes)
            ->with('rowsPlanes', $rows)
            ->with('organizaciones', $organizaciones);
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
            'nuevo', 'editar', 'keyword', 'organizacion',
            'show'
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
        }
        $plan->nombre = $this->nombre;
        $plan->etiqueta_factura = $this->etiqueta;
        $plan->bajada = $this->bajada;
        $plan->subida = $this->subida;
        $plan->precio = $this->precio;
        $plan->organizaciones_id = $this->organizaciones_id;
        $plan->save();

        $this->alert('success', 'Datos Guardados.');

        if ($this->cerrarModal){
            $this->limpiar();
            $this->dispatch('cerrarModal');
        }else{
            $this->showPlan($plan->id);
        }
    }

    public function edit($id, $cerrarModal = true)
    {
        $this->limpiar();
        $plan = Plan::find($id);
        if ($plan){

            $this->nombre = $plan->nombre;
            $this->etiqueta = $plan->etiqueta_factura;
            $this->bajada = $plan->bajada;
            $this->subida = $plan->subida;
            $this->precio = $plan->precio;
            $this->organizaciones_id = $plan->organizaciones_id;
            $this->organizacion = $plan->organizacion->nombre;

            $this->nuevo = false;
            $this->editar = true;
            $this->planes_id = $plan->id;

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            $this->dispatch('cerrarModal');
        }
    }

    public function showPlan($id)
    {
        $this->edit($id, false);
        $this->show = true;
    }

    public function destroy($id)
    {
        $this->planes_id = $id;
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
        $plan = Plan::find($this->planes_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $servicios = Servicio::where('planes_id', $this->planes_id)->first();
        if ($servicios){
            $vinculado = true;
        }

        $facturas = Factura::where('planes_id', $this->planes_id)->first();
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

}
