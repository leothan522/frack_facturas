<?php

namespace App\Livewire\Dashboard;

use App\Mail\BienvenidaMail;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Servicio;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientesComponent extends Component
{
    use ToastBootstrap;

    public $rows = 0, $numero = 14, $tableStyle = false;
    public $nuevo = true, $editar = false, $keyword;
    public $cedula, $nombre, $apellido, $email, $telefono, $direccion, $instalacion, $pago,
        $latitud, $longitud, $gps;
    public $cerrarModal= true, $show = false;

    #[Locked]
    public $clientes_id, $rowquid;

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

        $total = Cliente::buscar($this->keyword)->count();

        $rows = Cliente::count();

        if ($rows > $this->numero) {
            $this->tableStyle = true;
        }

        return view('livewire.dashboard.clientes-component')
            ->with('clientes', $clientes)
            ->with('rowsClientes', $rows)
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
            'cedula', 'nombre', 'apellido', 'email', 'telefono', 'direccion', 'instalacion',
            'pago', 'latitud', 'longitud', 'gps', 'clientes_id', 'nuevo', 'editar',
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
            'latitud' => 'nullable',
            'longitud' => 'nullable',
            'gps' => 'nullable',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->clientes_id){
            //editar
            $cliente = Cliente::find($this->clientes_id);
            $mail = false;
        }else{
            //nuevo
            $cliente = new Cliente();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Cliente::where('rowquid', $rowquid)->first();
            }while($existe);
            $cliente->rowquid = $rowquid;
            $mail = true;
        }

        if ($cliente){
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


            if ($mail){
                $this->sendBienvenida($cliente->id);
            }

            if (!$this->clientes_id){
                $this->reset('keyword');
            }

            if ($this->cerrarModal){
                $this->limpiar();
                $this->dispatch('cerrarModal');
                Sleep::for(500)->millisecond();
                $this->toastBootstrap();
            }else{
                $this->showCliente($cliente->rowquid);
                $this->toastBootstrap();
            }
        }else{
            $this->dispatch('cerrarModal');
        }

    }

    public function edit($rowquid, $cerrarModal = true)
    {
        $this->limpiar();
        $cliente = $this->getCliente($rowquid);
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
            $this->rowquid = $cliente->rowquid;

            $this->nuevo = false;
            $this->editar = true;
            $this->clientes_id = $cliente->id;

            if (!$cerrarModal){
                $this->cerrarModal = false;
            }

        }else{
            Sleep::for(500)->millisecond();
            $this->dispatch('cerrarModal');
        }

    }

    public function showCliente($rowquid)
    {
        $this->edit($rowquid, false);
        $this->show = true;
    }

    public function destroy($rowquid)
    {
        $this->rowquid = $rowquid;
        $this->confirmToastBootstrap('confirmed');
    }

    #[On('confirmed')]
    public function confirmed()
    {
        $id = null;
        $cliente = $this->getCliente($this->rowquid);
        if ($cliente){
            $id = $cliente->id;
        }
        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        $servicios = Servicio::where('clientes_id', $id)->first();
        if ($servicios){
            $vinculado = true;
        }

        $facturas = Factura::where('clientes_id', $id)->first();
        if ($facturas){
            $vinculado = true;
        }

        if ($vinculado) {
            $this->htmlToastBoostrap();
        } else {
            if ($cliente){
                $cedula = "<b>".$cliente->cedula."</b>";
                $cliente->cedula = "*".$cliente->cedula;
                $cliente->save();
                $cliente->delete();
                $this->dispatch('cerrarModal');
                Sleep::for(500)->millisecond();
                $this->toastBootstrap('success', "Cliente $cedula Eliminado.");
            }else{
                $this->dispatch('cerrarModal');
                $this->limpiar();
            }
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

    protected function getCliente($rowquid): ?Cliente
    {
        return Cliente::where('rowquid', $rowquid)->first();
    }

    public function btnReenviar()
    {
        $this->sendBienvenida($this->clientes_id);
        $this->toastBootstrap('info', 'Email Enviado.');
    }

    protected function sendBienvenida($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente){
            //anexamos los datos extras en data para enviar email
            $data['from_email'] = getCorreoSistema();
            $data['from_name'] = config('app.name');
            $data['subject'] = "Bienvenido a ENLAZADOSWIFI ELORZA";
            $data['nombre'] = strtoupper($cliente->nombre);
            $data['apellido'] = strtoupper($cliente->apellido);
            $data['email'] = getCorreoSistema();
            $data['telefono'] = getTelefonoSistema();
            //enviamos el correo
            $to = strtolower($cliente->email);
            Mail::to($to)->send(new BienvenidaMail($data));
        }
    }

}
