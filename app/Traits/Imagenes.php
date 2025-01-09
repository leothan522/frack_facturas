<?php

namespace App\Traits;

use App\Models\Imagen;

trait Imagenes
{
    public bool $saveImagen = false;

    public function setSaveImagen($option = true): void
    {
        $this->saveImagen = $option;
    }

    protected function getImagen($id, $nombre = null): array
    {
        $data = [
            'id' => null,
            'imagen' => null,
            'borrar' => null,
        ];

        if (empty($nombre)){
            $imagen = Imagen::where('bienes_id', $id)->first();
        }else{
            $imagen = Imagen::where('bienes_id', $id)->where('nombre', $nombre)->first();
        }

        if ($imagen){
            $data['id'] = $imagen->id;
            $data['imagen'] = $imagen->mini;
            $data['borrar'] = $imagen->imagen;
        }
        return $data;
    }

    protected function procesarImagen($id, $photo, $path, $tabla_id, $name = null): void
    {
        if (empty($name)){
            $name = $path;
        }

        if ($id){
            $imagen = Imagen::find($id);
            if ($imagen){
                borrarImagenes($imagen->imagen, $path);
            }
        }else{
            $imagen = new Imagen();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Imagen::where('rowquid', $rowquid)->first();
            }while($existe);
            $imagen->rowquid = $rowquid;
        }

        if ($imagen){
            $ruta = $photo->store("public/$path");
            $imagen->imagen = str_replace('public/', 'storage/', $ruta);
            //miniaturas
            $nombre = explode("$path/", $imagen->imagen);
            $path_data = "storage/$path/size_".$nombre[1];
            $miniatura = crearMiniaturas($imagen->imagen, $path_data);
            $imagen->mini = $miniatura['mini'];
            $imagen->bienes_id = $tabla_id;
            $imagen->nombre = $name;
            $imagen->save();
        }
    }

    protected function deleteImagen($id, $path)
    {
        $imagenes = Imagen::find($id);
        if ($imagenes){
            borrarImagenes($imagenes->imagen, $path);
            $imagenes->delete();
        }
    }

}
