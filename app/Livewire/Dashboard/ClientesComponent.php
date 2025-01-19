<?php

namespace App\Livewire\Dashboard;

use App\Mail\BienvenidaMail;
use App\Models\Antena;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Servicio;
use App\Traits\CardView;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use CardView;

    public $texto = "Cliente";
    public $cedula, $nombre, $apellido, $telefono, $email, $direccion;
    public $fechaInstalacion, $fechaPago, $latitud, $longitud, $gps, $rango, $antena, $verAntena, $verIP;

    public function mount()
    {
        $this->setLimit();
        $this->setTitle();
        $this->modulo = 'clientes';
        $this->lastRegistro();
        $this->setSize(306);
    }

    public function render()
    {
        $listar = Cliente::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Cliente::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.clientes-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarCardView();
        $this->reset([
            'cedula', 'nombre', 'apellido', 'telefono', 'email', 'direccion',
            'fechaInstalacion', 'fechaPago', 'latitud', 'longitud', 'gps', 'rango', 'antena', 'verAntena', 'verIP',
        ]);
        $this->resetErrorBag();
        $this->getAntenasSectoriales();
    }

    public function save()
    {
        $rules = [
            'cedula' => ['required', 'integer', 'min_digits:6', Rule::unique('clientes', 'cedula')->ignore($this->table_id)],
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'telefono' => 'required',
            'email' => 'required|email',
            'direccion' => 'required',
            'fechaInstalacion' => 'required',
            'fechaPago' => 'required',
            'latitud' => 'nullable',
            'longitud' => 'nullable',
            'gps' => 'nullable',
        ];
        $message = [
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.min_digits' => 'El campo cédula debe tener al menos 6 dígitos.',
            'cedula.unique' => 'El campo cédula ya ha sido registrado.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'fechaInstalacion.required' => 'El campo fecha instalación es obligatorio.',
        ];
        $this->validate($rules, $message);

        if ($this->table_id){
            //editar
            $model = Cliente::find($this->table_id);
            $enviarBienvenida = false;
        }else{
            //nuevo
            $model = new Cliente();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Cliente::where('rowquid', $rowquid)->first();
            }while($existe);
            $model->rowquid = $rowquid;
            $enviarBienvenida = true;
        }

        if ($model){

            $model->cedula = $this->cedula;
            $model->nombre = $this->nombre;
            $model->apellido = $this->apellido;
            $model->telefono = $this->telefono;
            $model->email = $this->email;
            $model->direccion = $this->direccion;
            $model->fecha_instalacion = $this->fechaInstalacion;
            $model->fecha_pago = $this->fechaPago;
            $model->latitud = $this->latitud;
            $model->longitud = $this->longitud;
            $model->gps = $this->gps;
            $model->antenas_id = $this->antena;
            $model->rango = $this->rango;
            $model->save();

            if ($enviarBienvenida){
                $this->sendBienvenida($model->id);
            }

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
        $registro = Cliente::where('rowquid', $rowquid)->first();
        if ($registro){

            $this->table_id = $registro->id;
            $this->rowquid = $registro->rowquid;

            $this->cedula = $registro->cedula;
            $this->nombre = $registro->nombre;
            $this->apellido = $registro->apellido;
            $this->telefono = $registro->telefono;
            $this->email = $registro->email;
            $this->direccion = $registro->direccion;
            $this->fechaInstalacion = $registro->fecha_instalacion;
            $this->fechaPago = $registro->fecha_pago;
            $this->latitud = $registro->latitud;
            $this->longitud = $registro->longitud;
            $this->gps = $registro->gps;
            $this->rango = $registro->rango;
            if ($registro->antenas_id){
                $this->antena = $registro->antenas_id;
                $this->verAntena = $registro->antena->nombre;
                $this->verIP = $registro->antena->direccion_ip;
            }

        }else{
            $this->lastRegistro();
        }
    }

    public function editCliente()
    {
        $this->getAntenasSectoriales();
        $this->dispatch('setSelectAntenas', id: $this->antena);
        $this->edit();
    }

    #[On('delete')]
    public function delete()
    {
        $registro = Cliente::find($this->table_id);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $servicios = Servicio::where('clientes_id', $registro->id)->first();
            $facturas = Factura::where('clientes_id', $registro->id)->first();

            if ($servicios || $facturas){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.formatoMillares($registro->cedula, 0).'</b>';
                $registro->delete();
                $this->lastRegistro();
                if ($this->ocultarTable){
                    $this->showHide();
                }
                $this->toastBootstrap('success', "$this->texto $nombre Eliminado.");
            }

        }
    }

    public function btnReenviar()
    {
        $this->sendBienvenida($this->table_id);
        $this->toastBootstrap('info', 'Email Enviado.');
    }

    public function btnPlanServicio()
    {
        $cliente = Cliente::find($this->table_id);
        if ($cliente){
            $this->dispatch('initClienteServicio', id: $cliente->id);
        }else{
            //cerrarModal
            Sleep::for(250)->milliseconds();
            $this->dispatch('cerrarModalClienteServicio');
        }
    }

    public function btnFacturasCliente()
    {
        $cliente = Cliente::find($this->table_id);
        if ($cliente){
            $this->dispatch('initFacturasCliente', id: $cliente->id);
        }else{
            //cerrarModal
            Sleep::for(250)->milliseconds();
            $this->dispatch('cerrarModalFacturasCliente');
        }
    }

    #[On('initSelectAntenas')]
    public function initSelectAntenas($data)
    {
        //JS
    }

    #[On('getSelectAntenas')]
    public function getSelectAntenas($id)
    {
        $antena = Antena::find($id);
        if ($antena){
            $this->antena = $antena->id;
        }
    }

    #[On('setSelectAntenas')]
    public function setSelectAntenas($id)
    {
        //JS
    }

    #[On('actualizarAntenas')]
    public function actualizarAntenas()
    {
        if ($this->form){
            $this->getAntenasSectoriales();
            $this->dispatch('setSelectAntenas', id: $this->antena);
        }else{
            $this->show($this->rowquid);
        }
    }

    protected function lastRegistro()
    {
        $registro = Cliente::orderBy('created_at', 'DESC')->first();
        if ($registro){
            $this->show($registro->rowquid);
        }else{
            $this->create();
        }

    }

    protected function getAntenasSectoriales()
    {
        $antena = Antena::orderBy('nombre', 'ASC')->get();
        $data = [];
        foreach ($antena as $row){
            $id = $row->id;
            $ip = "0.0.0.0";
            if ($row->direccion_ip){
                $ip = $row->direccion_ip;
            }
            $option = [
                'id' => $id,
                'text' => mb_strtoupper($row->nombre." | ".$ip)
            ];
            $data[] = $option;
        }
        $this->dispatch('initSelectAntenas', data: $data);
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
