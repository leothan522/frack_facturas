<?php

namespace App\Livewire\Dashboard;

use App\Mail\ContratoMail;
use App\Models\Cliente;
use App\Models\Organizacion;
use App\Models\Parametro;
use App\Models\Plan;
use App\Models\Servicio;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientesServiciosComponent extends Component
{
    use ToastBootstrap;

    public $title = "Plan de Servicio", $form = false;
    public $codigo, $organizaciones_id, $planes_id, $rowquidOrganizacion, $rowquidPlan;
    public $verOrganizacion, $nombre, $etiqueta, $bajada, $subida, $precio;

    #[Locked]
    public $clientes_id, $servicios_id;

    public function render()
    {
        return view('livewire.dashboard.clientes-servicios-component');
    }

    public function limpiar()
    {
        $this->reset([
            'title', 'form',
            'codigo', 'organizaciones_id', 'planes_id', 'rowquidOrganizacion', 'rowquidPlan',
            'verOrganizacion', 'nombre', 'etiqueta', 'bajada', 'subida', 'precio',
        ]);
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'organizaciones_id' => 'required',
            'planes_id' => 'required'
        ];
        $messages = [
            'organizaciones_id.required' => 'El campo organización es obligatorio.',
            'planes_id.required' => 'El campo plan de servicio es obligatorio.'
        ];
        $this->validate($rules, $messages);

        if ($this->servicios_id){
            //editar
            $servicio = Servicio::find($this->servicios_id);
            $mail = false;
        }else{
            //nuevo
            $servicio = new Servicio();
            $this->codigo = $this->getCodigoServicio();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Servicio::where('rowquid', $rowquid)->first();
            }while($existe);
            $servicio->rowquid = $rowquid;
            $mail = true;
        }

        if ($servicio){

            $servicio->codigo = $this->codigo;
            $servicio->clientes_id = $this->clientes_id;
            $servicio->organizaciones_id = $this->organizaciones_id;
            $servicio->planes_id = $this->planes_id;
            $servicio->save();

            if ($mail){
                $this->sendContrato($servicio->id);
            }

            $this->initModal($this->clientes_id);
            $this->toastBootstrap();
        }
    }

    public function btnReenviar()
    {
        $this->sendContrato($this->servicios_id);
        $this->toastBootstrap('info', 'Contrato enviado.');
    }

    protected function sendContrato($id)
    {
        $servicios = Servicio::find($id);
        $data = [
            'from_email' => getCorreoSistema(),
            'from_name' => config('app.name'),
            'subject' => "CONTRATO DE SERVICIO",
            'organizacion_nombre' => strtoupper($servicios->organizacion->nombre),
            'organizacion_direccion' => strtoupper($servicios->organizacion->direccion),
            'organizacion_moneda' => $servicios->organizacion->moneda,
            'organizacion_representante' => strtoupper($servicios->organizacion->representante),
            'cliente_nombre' => strtoupper($servicios->cliente->nombre),
            'cliente_direccion' => strtoupper($servicios->cliente->direccion),
            'cliente_fecha_pago' => $servicios->cliente->fecha_pago,
            'plan_bajada' => cerosIzquierda($servicios->plan->bajada, 2),
            'plan_subida' => cerosIzquierda($servicios->plan->subida, 2),
            'plan_precio' => formatoMillares($servicios->plan->precio),
            'limite_datos' => "Sin Límite de Datos",
            'metodos' => "los establecidos en el territorio nacional",
            'terminacion_contrato' => 10,
        ];
        $to = $servicios->cliente->email;
        Mail::to($to)->send(new ContratoMail($data));
    }

    public function edit()
    {
        $this->dataOrganizacion();
        $this->form = true;
    }

    #[On('deleteClienteServicio')]
    public function delete()
    {
        $registro = Servicio::find($this->servicios_id);
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->codigo.'</b>';
                $registro->delete();
                $this->initModal($this->clientes_id);
                $this->toastBootstrap('success', "Servicio $nombre Eliminado.");
            }

        }
    }

    #[On('initClienteServicio')]
    public function initModal($id)
    {
        $this->limpiar();
        $this->clientes_id = $id;
        $servicio = Servicio::where('clientes_id', $this->clientes_id)->first();
        if ($servicio){

            $this->servicios_id = $servicio->id;
            $this->codigo = $servicio->codigo;
            $this->organizaciones_id = $servicio->organizaciones_id;
            $this->planes_id = $servicio->planes_id;
            $this->rowquidOrganizacion = $servicio->organizacion->rowquid;
            $this->rowquidPlan = $servicio->plan->rowquid;

            $this->verOrganizacion = Organizacion::find($servicio->organizaciones_id);
            $this->nombre = $servicio->plan->nombre;
            $this->etiqueta = $servicio->plan->etiqueta_factura;
            $this->bajada = $servicio->plan->bajada;
            $this->subida = $servicio->plan->subida;
            $this->precio = $servicio->plan->precio;

        }else{
            $this->reset(['servicios_id']);
            $this->title = "Crear Servicio";
            $this->form = true;
            $this->dataOrganizacion();
            $this->dispatch('setSelectPlan', rowquid: '');
        }
    }

    #[On('cerrarModalClienteServicio')]
    public function cerrarModal()
    {
        //JS
    }

    #[On('initSelectOrganizacion')]
    public function initSelectOrganizacion($data)
    {
        if ($this->organizaciones_id){
            $this->dispatch('setSelectOrganizacion', rowquid: $this->rowquidOrganizacion);
        }
        //JS
    }

    #[On('getSelectOrganizacion')]
    public function getSelectOrganizacion($rowquid)
    {
        $organzazion = Organizacion::where('rowquid', $rowquid)->first();
        if ($organzazion){
            $this->organizaciones_id = $organzazion->id;
            $this->dataPlan($organzazion->id);
        }else{
            $this->reset(['organizaciones_id', 'planes_id']);
        }
    }

    #[On('setSelectOrganizacion')]
    public function setSelectOrganizacion($rowquid)
    {
        //JS
    }

    #[On('initSelectPlan')]
    public function initSelectPlan($data)
    {
        if ($this->planes_id){
            $this->dispatch('setSelectPlan', rowquid: $this->rowquidPlan);
        }
        //JS
    }

    #[On('getSelectPlan')]
    public function getSelectPlan($rowquid)
    {
        $plan = Plan::where('rowquid', $rowquid)->first();
        if ($plan){
            $this->planes_id = $plan->id;
        }else{
            $this->reset(['planes_id']);
        }
    }

    #[On('setSelectPlan')]
    public function setSelectPlan($rowquid)
    {
        //JS
    }

    protected function dataOrganizacion()
    {
        $organizaciones = Organizacion::orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($organizaciones, 'nombre');
        $this->dispatch('initSelectOrganizacion', data: $data);
    }

    protected function dataPlan($id)
    {
        $planes = Plan::where('organizaciones_id', $id)->orderBy('nombre', 'ASC')->get();
        $data = getDataSelect2($planes, 'nombre');
        $this->dispatch('initSelectPlan', data: $data);
    }

    protected function getCodigoServicio(): string
    {
        $parametro = Parametro::where("nombre", 'proximo_codigo_servicios')->first();
        if ($parametro) {
            $numero = $parametro->tabla_id;
            $formato = $parametro->valor;
            $id = $parametro->id;
        }else{
            $numero = 1;
            $formato = "S-";
            $id = null;
        }

        $size = cerosIzquierda($numero, numSizeCodigo());
        $codigo = $formato . $size;
        $this->saveParametro('proximo_codigo_servicios', ++$numero, $formato, $id);
        return $codigo;
    }

    protected function saveParametro($nombre, $tabla_id, $valor, $id = null): void
    {
        if ($id){
            $parametro = Parametro::find($id);
        }else{
            $parametro = new Parametro();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }

        if ($parametro){
            $parametro->nombre = $nombre;
            $parametro->tabla_id = $tabla_id;
            $parametro->valor = $valor;
            $parametro->save();
        }
    }

}
