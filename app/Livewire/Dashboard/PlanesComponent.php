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
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nuevo = true, $editar = false, $planes_id, $keyword;
    public $nombre, $bajada, $subida, $precio, $organizaciones_id, $etiqueta;

    public function render()
    {
        $planes = Plan::buscar($this->keyword)->orderBy('updated_at', 'DESC')->paginate(numRowsPaginate());
        $organizaciones = Organizacion::orderBy('nombre', 'ASC')->get();
        return view('livewire.dashboard.planes-component')
            ->with('planes', $planes)
            ->with('organizaciones', $organizaciones)
            ;
    }

    public function limpiar()
    {
        $this->reset([
            'nombre', 'bajada', 'subida', 'precio', 'organizaciones_id', 'planes_id', 'etiqueta',
            'nuevo', 'editar', 'keyword'
        ]);
        $this->resetErrorBag();
    }

    protected function rules()
    {
        return [
            'nombre' => 'required|min:4',
            'etiqueta' => 'required|min:4',
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

        $this->limpiar();

        $this->alert('success', 'Datos Guardados.');
    }

    public function edit($id)
    {
        $plan = Plan::find($id);
        $this->nombre = $plan->nombre;
        $this->etiqueta = $plan->etiqueta_factura;
        $this->bajada = $plan->bajada;
        $this->subida = $plan->subida;
        $this->precio = $plan->precio;
        $this->organizaciones_id = $plan->organizaciones_id;
        $this->nuevo = false;
        $this->editar = true;
        $this->planes_id = $plan->id;
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
            $plan->delete();
            $this->alert(
                'success',
                'Plan Eliminado.'
            );
            $this->limpiar();
        }
    }

    #[On('buscar')]
    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

}
