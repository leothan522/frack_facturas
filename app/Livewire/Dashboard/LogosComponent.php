<?php

namespace App\Livewire\Dashboard;

use App\Models\Organizacion;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class LogosComponent extends Component
{
    use ToastBootstrap;
    use WithFileUploads;

    public $verImagen, $clinkImagen = false, $iconoBorrar = false, $btnGuardar = false;
    public $organizacion, $photo, $imagen, $mini, $img_borrar, $temporal, $borrarImg = false;

    #[Locked]
    public $organizaciones_id;

    public function mount()
    {
        $this->changeImagen();
    }

    public function render()
    {
        $organizaciones = Organizacion::all();
        return view('livewire.dashboard.logos-component')
            ->with('listarOrganizaciones', $organizaciones);
    }

    #[On('limpiarLogo')]
    public function limpiarLogo()
    {
        if ($this->temporal){
            borrarImagenes($this->temporal, 'organizaciones');
        }

        $this->reset([
            'clinkImagen', 'iconoBorrar', 'btnGuardar',
            'organizacion', 'photo', 'imagen', 'mini' ,'img_borrar', 'temporal', 'organizaciones_id', 'borrarImg'
        ]);

        $this->resetErrorBag();
        $this->changeImagen();
    }

    public function updatedOrganizacion()
    {
        if (!empty($this->organizacion)){
            $organizacion = Organizacion::where('rowquid', $this->organizacion)->first();
            if ($organizacion){
                if ($this->temporal){
                    borrarImagenes($this->temporal, 'organizaciones');
                    $this->reset('temporal');
                }
                $this->imagen = !empty($organizacion->imagen) ? $organizacion->imagen : null;
                $this->mini = !empty($organizacion->mini) ? $organizacion->mini : null;
                $this->changeImagen($this->mini);
                $this->iconoBorrar = !empty($organizacion->imagen);
                $this->clinkImagen = true;
                $this->organizaciones_id = $organizacion->id;
            }else{
                $this->limpiarLogo();
            }
        }else{
            $this->limpiarLogo();
        }
    }

    protected function changeImagen($imagen = 'init')
    {
        if ($imagen == 'init'){
            $this->verImagen = verImagen('img/interrogacion.jpg', false, true);
        }else{
            if (is_null($imagen)){
                $this->verImagen = verImagen($imagen);
            }else{
                $this->verImagen = verImagen($imagen, false, true);
            }
        }

    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ],
        [
            'photo.max' => 'La imagen no debe ser mayor que 1024 kilobytes.'
        ]);
        if ($this->imagen){
            $this->img_borrar = $this->imagen;
        }
        if ($this->temporal){
            borrarImagenes($this->temporal, 'organizaciones');
        }
        $this->temporal = crearImagenTemporal($this->photo, 'organizaciones');
        $this->changeImagen($this->temporal);
        $this->iconoBorrar = true;
        $this->btnGuardar = true;
    }

    public function save()
    {
        $rules = [
            'photo' => 'nullable|image|max:1024', // 1MB Max
            'organizacion' => 'required'
        ];

        $messages = [
            'photo.max' => 'La imagen no debe ser mayor que 1024 kilobytes.'
        ];

        $this->validate($rules, $messages);

        $organizacion = Organizacion::find($this->organizaciones_id);
        if ($organizacion){

            if ($this->photo){
                $ruta = $this->photo->store('public/organizaciones');
                $organizacion->imagen = str_replace('public/', 'storage/', $ruta);
                //miniaturas
                $nombre = explode('organizaciones/', $organizacion->imagen);
                $path_data = "storage/organizaciones/size_".$nombre[1];
                $miniatura = crearMiniaturas($organizacion->imagen, $path_data);
                $organizacion->mini = $miniatura['mini'];
                //borramos la imagen temporal
                borrarImagenes($this->temporal, 'organizaciones');
                //borramos imagenes anteriones si existen
                if ($this->img_borrar){
                    borrarImagenes($this->img_borrar, 'organizaciones');
                }
            }else{
                if ($this->img_borrar){
                    $organizacion->imagen = null;
                    $organizacion->mini = null;
                    borrarImagenes($this->img_borrar, 'organizaciones');
                }
            }

            $organizacion->save();

            $this->imagen = $organizacion->imagen;
            $this->mini = $organizacion->mini;
            $this->reset('temporal', 'photo', 'btnGuardar', 'img_borrar');
            $this->toastBootstrap();

        }else{
            $this->limpiarLogo();
        }
    }

    public function btnBorrarImagen()
    {
        if ($this->temporal){
            borrarImagenes($this->temporal, 'organizaciones');
            if (!$this->borrarImg){
                $this->reset('btnGuardar');
                $this->changeImagen($this->mini);
            }else{
                $this->changeImagen(null);
            }
            if (!$this->imagen){
                $this->reset('iconoBorrar');
            }
            $this->reset('temporal', 'photo');
        }else{
            $this->borrarImg = true;
            if ($this->imagen){
                $this->img_borrar = $this->imagen;
                $this->btnGuardar = true;
            }
            $this->reset(['imagen', 'iconoBorrar']);
            $this->changeImagen($this->imagen);
        }

    }

}
