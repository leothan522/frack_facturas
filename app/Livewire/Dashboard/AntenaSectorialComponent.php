<?php

namespace App\Livewire\Dashboard;

use App\Models\Antena;
use App\Models\Cliente;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class AntenaSectorialComponent extends Component
{
    use ToastBootstrap;

    public $title = "Nueva Antena", $form = false, $nuevo = true;
    public $nombre, $ip;

    #[Locked]
    public $antenas_id, $rowquid;

    public function render()
    {
        $antenas = Antena::orderBy('created_at', 'ASC')->get();
        return view('livewire.dashboard.antena-sectorial-component')
            ->with('listar', $antenas);
    }

    public function limpiar()
    {
        $this->reset([
            'title', 'form', 'nuevo',
            'nombre', 'ip',
            'antenas_id',
        ]);
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:4', 'max:15', Rule::unique('antenas_sectoriales', 'nombre')->ignore($this->antenas_id)],
            'ip' => ['nullable', 'ip', Rule::unique('antenas_sectoriales', 'direccion_ip')->ignore($this->antenas_id)],
            //'nombre' => 'required|min:4|max:15',
            //'ip' => 'nullable|ip'
        ];
        $this->validate($rules);

        if ($this->antenas_id){
            //editar
            $antena = Antena::find($this->antenas_id);
            $this->nuevo = false;
        }else{
            $antena = new Antena();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Antena::where('rowquid', $rowquid)->first();
            }while($existe);
            $antena->rowquid = $rowquid;
        }

        if ($antena){
            $antena->nombre = $this->nombre;
            $antena->direccion_ip = $this->ip;
            $antena->save();
            if ($this->nuevo){
                $this->edit($antena->rowquid);
            }else{
                $this->limpiar();
            }
            $this->toastBootstrap();
        }
    }

    public function edit($rowquid)
    {
        $this->limpiar();
        $antena = Antena::where('rowquid', $rowquid)->first();
        if ($antena){
            $this->antenas_id = $antena->id;
            $this->nombre = $antena->nombre;
            $this->ip = $antena->direccion_ip;
            $this->form = true;
        }
    }

    #[On('deleteAntena')]
    public function delete()
    {
        $registro = Antena::find($this->antenas_id);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $clientes = Cliente::where('antenas_id', $registro->id)->first();

            if ($clientes){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->nombre.'</b>';
                $registro->delete();
                $this->limpiar();
                $this->toastBootstrap('success', "Antena $nombre Eliminada.");
            }

        }
    }

    public function cancel()
    {
        $this->limpiar();
    }

    #[On('initModalAntena')]
    public function initModalAntena()
    {
        $this->limpiar();
    }
}
