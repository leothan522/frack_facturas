<?php

namespace App\Livewire\Dashboard;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Servicio;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ClientesComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $clientes_id, $keyword;
    public $cedula, $nombre, $apellido, $email, $telefono, $direccion, $instalacion, $pago,
        $latitud, $longitud, $gps;
    public $cerrarModal= true, $show = false;

    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $clientes = Cliente::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->rows)
            ->get();

        $rows = Cliente::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        return view('livewire.dashboard.clientes-component')
            ->with('clientes', $clientes)
            ->with('rowsClientes', $rows);
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
            'cedula', 'nombre', 'apellido', 'email', 'telefono', 'direccion', 'instalacion',
            'pago', 'latitud', 'longitud', 'gps', 'clientes_id', 'nuevo', 'editar', 'keyword',
            'show'
        ]);
        $this->resetErrorBag();
    }

    protected function rules()
    {
        return [
            'cedula' => ['required', 'integer', Rule::unique('clientes', 'cedula')->ignore($this->clientes_id)],
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

        if ($this->clientes_id){
            //editar
            $cliente = Cliente::find($this->clientes_id);
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

        $this->alert('success', 'Datos Guardados.');

        if ($this->cerrarModal){
            $this->limpiar();
            $this->dispatch('cerrarModal');
        }else{
            $this->showCliente($cliente->id);
        }

    }

    public function edit($id, $cerrarModal = true)
    {
        $this->limpiar();
        $cliente = Cliente::find($id);
        if ($cliente){

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
            $this->clientes_id = $cliente->id;

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            $this->dispatch('cerrarModal');
        }

    }

    public function showCliente($id)
    {
        $this->edit($id, false);
        $this->show = true;
    }

    public function destroy($id)
    {
        $this->clientes_id = $id;
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
        $cliente = Cliente::find($this->clientes_id);
        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $servicios = Servicio::where('clientes_id', $this->clientes_id)->first();
        if ($servicios){
            $vinculado = true;
        }

        $facturas = Factura::where('clientes_id', $this->clientes_id)->first();
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
            if ($cliente){
                $cliente->cedula = "*".$cliente->cedula;
                $cliente->save();
                $cliente->delete();
                $this->alert('success', 'Cliente Eliminado.');
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
