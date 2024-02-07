<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cliente;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ClientesComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmed', 'buscar'];

    public $nuevo = true, $editar = false, $cliente_id, $keyword;
    public $cedula, $nombre, $apellido, $email, $telefono, $direccion, $instalacion, $pago,
        $latitud, $longitud, $gps;

    public function render()
    {
        $clientes = Cliente::buscar($this->keyword)->orderBy('updated_at', 'DESC')->paginate(numRowsPaginate());
        return view('livewire.dashboard.clientes-component')
            ->with('clientes', $clientes);
    }

    public function limpiar()
    {
        $this->reset([
            'cedula', 'nombre', 'apellido', 'email', 'telefono', 'direccion', 'instalacion',
            'pago', 'latitud', 'longitud', 'gps', 'cliente_id', 'nuevo', 'editar', 'keyword'
        ]);
        $this->resetErrorBag();
    }

    protected function rules()
    {
        return [
            'cedula' => ['required', 'integer', Rule::unique('clientes', 'cedula')->ignore($this->cliente_id)],
            'nombre' => 'required|min:4',
            'apellido' => 'required|min:4',
            'email' => 'required|email',
            'telefono' => 'required',
            'direccion' => 'required',
            'instalacion' => 'required',
            'pago' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'gps' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->cliente_id){
            //editar
            $cliente = Cliente::find($this->cliente_id);
        }else{
            //nuevo
            $cliente = new Cliente();
        }
        $cliente->cedula = $this->cedula;
        $cliente->nombre = $this->nombre;
        $cliente->apellido = $this->apellido;
        $cliente->email = $this->email;
        $cliente->telefono = $this->telefono;
        $cliente->direccion = $this->direccion;
        $cliente->fecha_instalacion = $this->instalacion;
        $cliente->fecha_pago = $this->pago;
        $cliente->latitud = $this->latitud;
        $cliente->longitud = $this->longitud;
        $cliente->gps = $this->gps;
        $cliente->save();

        $this->limpiar();

        $this->alert('success', 'Datos Guardados.');
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $this->cedula = $cliente->cedula;
        $this->nombre = $cliente->nombre;
        $this->apellido = $cliente->apellido;
        $this->email = $cliente->email;
        $this->telefono = $cliente->telefono;
        $this->direccion = $cliente->direccion;
        $this->instalacion = $cliente->fecha_instalacion;
        $this->pago = $cliente->fecha_pago;
        $this->latitud = $cliente->latitud;
        $this->longitud = $cliente->longitud;
        $this->gps = $cliente->gps;
        $this->nuevo = false;
        $this->editar = true;
        $this->cliente_id = $cliente->id;
    }

    public function destroy($id)
    {
        $this->cliente_id = $id;
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

    public function confirmed()
    {
        $cliente = Cliente::find($this->cliente_id);
        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

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
            $cliente->delete();
            $this->alert(
                'success',
                'Cliente Eliminado.'
            );
            $this->limpiar();
        }
    }

    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }


}
