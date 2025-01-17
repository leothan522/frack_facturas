<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Imagen;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use App\Traits\CardView;
use App\Traits\Imagenes;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrganizacionesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use CardView;
    use WithFileUploads;
    use Imagenes;

    public $texto = "Organización";
    public $nombre, $representante, $email, $telefono, $web, $moneda, $dias, $formato, $proxima, $direccion;
    public $imagen, $mini, $imgID, $photo, $imgBorrar = false, $btnImgBorrar = false;

    public function mount()
    {
        $this->setLimit();
        $this->setTitle();
        $this->modulo = 'organizaciones';
        $this->lastRegistro();
        $this->setSize(306);
    }

    public function render()
    {
        $listar = Organizacion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Organizacion::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.organizaciones-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarCardView();
        $this->reset([
            'nombre', 'representante', 'email', 'telefono', 'web', 'moneda', 'dias', 'formato', 'proxima', 'direccion',
            'imagen','mini', 'imgID', 'photo', 'imgBorrar', 'btnImgBorrar',
        ]);
        $this->resetErrorBag();
        $this->setSaveImagen(false);
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:3', Rule::unique('organizaciones', 'nombre')->ignore($this->table_id)],
            'representante' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'moneda' => 'required',
            'direccion' => 'required',
            'dias' => 'required|integer|gt:0|max:28',
            'formato' => 'nullable',
            'proxima' => 'nullable|integer|gt:0',
            'web' => 'nullable|url:http,https',
            'photo'     => 'nullable|image|max:2024',
        ];
        $message = [
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'dias.required' => 'El campo días factura es obligatorio.',
            'dias.gt' => 'El campo días factura debe ser mayor que 0.',
            'dias.max' => 'El campo días factura no debe ser mayor que 28.',
            'proxima.gt' => 'El campo próxima factura debe ser mayor que 0.',
            'photo.max' => 'La imagen no debe ser mayor que 2 megabytes.',
        ];
        $this->validate($rules, $message);

        if ($this->table_id){
            //editar
            $model = Organizacion::find($this->table_id);
        }else{
            //nuevo
            $model = new Organizacion();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Organizacion::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
        }

        if ($model){

            $model->nombre = $this->nombre;
            $model->representante = $this->representante;
            $model->email = $this->email;
            $model->telefono = $this->telefono;
            $model->moneda = $this->moneda;
            $model->direccion = $this->direccion;
            $model->dias_factura = $this->dias;
            $model->formato_factura = $this->formato;
            $model->proxima_factura = $this->proxima;
            $model->web = $this->web;
            $model->save();

            if ($this->saveImagen){
                $this->procesarImagen($this->imgID, $this->photo, 'organizaciones', $model->id);
                borrarImagenes($this->imagen, 'organizaciones');
            }else{
                if ($this->imgBorrar){
                    $this->deleteImagen($this->imgID, 'organizaciones');
                }
            }

            $this->show($model->rowquid);
            $this->toastBootstrap();

        }

    }

    public function show($rowquid)
    {
        $this->limpiar();
        $this->setSizeFooter();
        $registro = Organizacion::where('rowquid', $rowquid)->first();
        if ($registro){

            $this->table_id = $registro->id;
            $this->rowquid = $registro->rowquid;

            $this->nombre = $registro->nombre;
            $this->representante = $registro->representante;
            $this->email = $registro->email;
            $this->telefono = $registro->telefono;
            $this->moneda = $registro->moneda;
            $this->direccion = $registro->direccion;
            $this->dias = $registro->dias_factura;
            $this->formato = $registro->formato_factura;
            $this->proxima = $registro->proxima_factura;
            $this->web = $registro->web;

            $imagenes  = Imagen::where('tabla_id', $registro->id)->where('nombre',  'organizaciones')->first();
            if ($imagenes){
                $this->btnImgBorrar = true;
                $this->imgID = $imagenes->id;
                $this->imagen = $imagenes->imagen;
                $this->mini = $imagenes->mini;
            }


        }
    }

    #[On('delete')]
    public function delete()
    {
        $registro = Organizacion::find($this->table_id);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $servicios = Servicio::where('organizaciones_id', $registro->id)->first();
            $facturas = Factura::where('organizaciones_id', $registro->id)->first();
            $planes = Plan::where('organizaciones_id', $registro->id)->first();

            if ($servicios || $facturas || $planes){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->nombre.'</b>';
                $registro->delete();
                $this->deleteImagen($this->imgID, 'organizaciones');
                $this->lastRegistro();
                if ($this->ocultarTable){
                    $this->showHide();
                }
                $this->toastBootstrap('success', "$this->texto $nombre Eliminada.");
            }

        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2024', // 1MB Max
        ], [
            'photo.max' => "La imagen no debe ser mayor que 2 megabytes."
        ]);

        $this->imagen = crearImagenTemporal($this->photo, 'organizaciones');
        $this->setSaveImagen();
    }

    public function btnBorrarImagen()
    {
        if ($this->saveImagen){
            borrarImagenes($this->imagen, 'organizaciones');
            $this->setSaveImagen(false);
            $this->imagen = $this->mini;
        }else{
            if ($this->btnImgBorrar){
                $this->reset(['btnImgBorrar', 'imagen']);
                $this->imgBorrar = true;
            }
        }

        $this->reset(['photo']);
        $this->resetErrorBag(['photo']);
    }

    protected function lastRegistro()
    {
        $registro = Organizacion::orderBy('created_at', 'DESC')->first();
        if ($registro){
            $this->show($registro->rowquid);
        }else{
            $this->create();
        }

    }

}
