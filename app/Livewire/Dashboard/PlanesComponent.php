<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use App\Traits\CardView;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class PlanesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use CardView;

    public $texto = "Plan";
    public $verOrganizacion;
    public $organizaciones_id, $nombre, $etiqueta, $bajada, $subida, $precio;

    public function mount()
    {
        $this->setLimit();
        $this->setTitle();
        $this->modulo = 'planes';
        $this->lastRegistro();
        $this->setSize(306);
    }

    public function render()
    {
        $listar = Plan::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Plan::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.planes-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarCardView();
        $this->reset([
            'verOrganizacion',
            'organizaciones_id', 'nombre', 'etiqueta', 'bajada', 'subida', 'precio',
        ]);
        $this->resetErrorBag();
        $this->dataOrganizacion();
    }

    public function save()
    {
        $rules = [
            'nombre' => 'required|min:3',
            'etiqueta' => 'required',
            'bajada' => 'required|integer|gt:0',
            'subida' => 'required|integer|gt:0',
            'precio' => 'required|numeric|gt:0',
            'organizaciones_id' => 'required',
        ];
        $message = [
            'organizaciones_id.required' => 'El campo organización es obligatorio.',
            'etiqueta.required' => 'El campo etiqueta - factura es obligatorio.',
            'bajada.required' => 'La velocidad de bajada es obligatoria.',
            'bajada.gt' => 'La velocidad de bajada debe ser mayor que 0.',
            'subida.gt' => 'La velocidad de subida debe ser mayor que 0.',
            'subida.required' => 'La velocidad de subida es obligatoria.',
            'precio.required' => 'El campo precio mensual es obligatorio.',
            'precio.gt' => 'El campo precio debe ser mayor que 0.',
        ];
        $this->validate($rules, $message);

        if ($this->table_id){
            //editar
            $model = Plan::find($this->table_id);
        }else{
            //nuevo
            $model = new Plan();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Plan::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
        }

        if ($model){

            $model->organizaciones_id = $this->organizaciones_id;
            $model->nombre = $this->nombre;
            $model->etiqueta_factura = $this->etiqueta;
            $model->bajada = $this->bajada;
            $model->subida = $this->subida;
            $model->precio = $this->precio;
            $model->save();

            $this->show($model->rowquid);
            $this->toastBootstrap();

        }else{
            $this->lastRegistro();
        }

    }

    public function show($rowquid)
    {
        $this->limpiar();
        $this->setSizeFooter();
        $registro = Plan::where('rowquid', $rowquid)->first();
        if ($registro){

            $this->table_id = $registro->id;
            $this->rowquid = $registro->rowquid;

            $this->organizaciones_id = $registro->organizaciones_id;
            $this->nombre = $registro->nombre;
            $this->etiqueta = $registro->etiqueta_factura;
            $this->bajada = $registro->bajada;
            $this->subida = $registro->subida;
            $this->precio = $registro->precio;

            $this->getOrganizacion($registro->organizaciones_id);
            $this->dispatch('setSelectOrganizacion', rowquid: $registro->organizacion->rowquid);

        }else{
            $this->lastRegistro();
        }
    }

    #[On('delete')]
    public function delete()
    {
        $registro = Plan::find($this->table_id);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $servicios = Servicio::where('planes_id', $registro->id)->first();
            $facturas = Factura::where('planes_id', $registro->id)->first();

            if ($servicios || $facturas){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->nombre.'</b>';
                $registro->delete();
                $this->lastRegistro();
                if ($this->ocultarTable){
                    $this->showHide();
                }
                $this->toastBootstrap('success', "$this->texto $nombre Eliminado.");
            }

        }
    }

    #[On('initSelectOrganizacion')]
    public function initSelectOrganizacion($data)
    {
        //JS
    }

    #[On('getSelectOrganizacion')]
    public function getSelectOrganizacion($rowquid)
    {
        $organzazion = Organizacion::where('rowquid', $rowquid)->first();
        if ($organzazion){
            $this->organizaciones_id = $organzazion->id;
        }
    }

    #[On('setSelectOrganizacion')]
    public function setSelectOrganizacion($rowquid)
    {
        //JS
    }

    protected function dataOrganizacion()
    {
        $organizaciones = Organizacion::orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($organizaciones, 'nombre');
        $this->dispatch('initSelectOrganizacion', data: $data);
    }

    protected function getOrganizacion($id)
    {
        $organizacion = Organizacion::find($id);
        if ($organizacion){
            $this->verOrganizacion = $organizacion;
        }
    }

    protected function lastRegistro()
    {
        $registro = Plan::orderBy('created_at', 'DESC')->first();
        if ($registro){
            $this->show($registro->rowquid);
        }else{
            $this->create();
        }

    }

}
