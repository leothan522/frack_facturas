<?php

namespace App\Livewire\Dashboard;

use App\Models\Banco;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Metodo;
use App\Models\Pago;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PagosRegistrarComponent extends Component
{
    use ToastBootstrap;

    public $title = "Registrar Pago";
    public int $size = 251; //max-height: 305px;
    public $clientes_id, $facturas_id;
    public $verOrganizacionFactura, $verNumeroFactura, $verFechaFactura, $verTotalFactura;
    public $listarMetodos, $ocultarBanco = true;

    public $metodo, $bancos_id, $referencia, $fecha, $monto;
    public $titular, $cuenta, $tipo, $cedula, $telefono, $email, $nombre, $codigo, $dollar, $factura_numero;

    #[Locked]
    public $pagos_id;
    public function render()
    {
        $this->getMetodos();
        return view('livewire.dashboard.pagos-registrar-component');
    }

    public function limpiar()
    {
        $this->reset([
            'title', 'clientes_id', 'facturas_id', 'ocultarBanco',
            'verOrganizacionFactura', 'verNumeroFactura', 'verFechaFactura', 'verTotalFactura',
            'metodo', 'bancos_id', 'referencia', 'fecha', 'monto',
            'titular', 'cuenta', 'tipo', 'cedula', 'telefono', 'email', 'nombre', 'codigo', 'dollar', 'factura_numero',
            'pagos_id',
        ]);
        $this->resetErrorBag();
        $this->dataClientes();
    }

    public function updatedMetodo()
    {
        if (!empty($this->metodo)){
            $model = Metodo::where('metodo', $this->metodo)->first();
            if ($model){
                if ($model->metodo != 'zelle'){
                    $this->ocultarBanco = false;
                    $this->getBancos();
                }else{
                    $this->ocultarBanco = true;
                    $this->reset(['bancos_id']);
                }
                $this->titular = $model->titular;
                $this->cuenta = $model->cuenta;
                $this->tipo = $model->tipo;
                $this->cedula = $model->cedula;
                $this->telefono = $model->telefono;
                $this->email = $model->email;
                $this->dollar = getDollar();
            }else{
                $this->reset(['metodo']);
            }
        }else{
            $this->reset(['ocultarBanco', 'bancos_id']);
        }
    }

    public function save()
    {
        $rules = [
            'clientes_id' => 'required',
            'facturas_id' => 'required',
            'metodo' => 'required',
            'referencia' => ['required', 'alpha_num', 'min:8', 'max:15', Rule::unique('pagos', 'referencia')],
            'bancos_id' => Rule::requiredIf($this->metodo != "zelle"),
            'fecha' => 'required',
            'monto' => 'required|numeric'
        ];
        $messages = [
            'clientes_id.required' => 'El campo cliente es obligatorio.',
            'facturas_id.required' => 'El campo factura es obligatorio.',
            'bancos_id.required' => 'El campo banco es obligatorio.',
            'fecha.required' => 'El campo fecha pago es obligatorio.',
        ];
        $this->validate($rules, $messages);

        if ($this->pagos_id){
            $pago = Pago::find($this->pagos_id);
            if ($pago){
                $pago->referencia = "*".$pago->referencia;
                $pago->save();
                $pago->delete();
            }
        }

        $pago = new Pago();
        $pago->referencia = $this->referencia;
        $pago->fecha = $this->fecha;
        $pago->monto = $this->monto;
        if ($this->metodo != 'zelle'){
            $pago->moneda = 'Bs';
        }else{
            $pago->moneda = 'USD';
        }
        $pago->metodo = $this->metodo;
        $pago->titular = $this->titular;
        $pago->cuenta = $this->cuenta;
        $pago->tipo = $this->tipo;
        $pago->cedula = $this->cedula;
        $pago->telefono = $this->telefono;
        $pago->email = $this->email;
        $pago->nombre = $this->nombre;
        $pago->codigo = $this->codigo;
        $pago->dollar = $this->dollar;
        $pago->factura_numero = $this->factura_numero;
        $pago->clientes_id = $this->clientes_id;
        $pago->facturas_id = $this->facturas_id;
        $pago->estatus = 1;
        $pago->band = 1;
        do{
            $rowquid = generarStringAleatorio(16);
            $existe = Pago::where('rowquid', $rowquid)->first();
        }while($existe);
        $pago->rowquid = $rowquid;
        $pago->save();

        $factura = Factura::find($this->facturas_id);
        $factura->pagos_id = $pago->id;
        $factura->estatus = 1;
        $factura->save();

        $this->dispatch('cerrarFormRegistro');
        $this->toastBootstrap();
    }

    #[On('initRegistrarPago')]
    public function initForm($id = null)
    {
        $this->limpiar();
    }

    #[On('initSelectCliente')]
    public function initSelectCliente($data)
    {
        //JS
    }

    #[On('getSelectCliente')]
    public function getSelectCliente($id)
    {
        $this->clientes_id = $id;
        //dd($this->getFacturasCliente($id));
        $this->dispatch('initSelectFactura', data: $this->getFacturasCliente($id));
    }

    #[On('initSelectFactura')]
    public function initSelectFactura($data)
    {
        //JS
    }

    #[On('getSelectFactura')]
    public function getSelectFactura($id)
    {
        $factura = Factura::find($id);
        if ($factura){
            $this->facturas_id = $factura->id;
            $this->factura_numero = $factura->factura_numero;
            $this->verOrganizacionFactura = $factura->organizacion->nombre;
            $this->verNumeroFactura = $factura->factura_numero;
            $this->verFechaFactura = getFecha($factura->factura_fecha);
            if ($factura->organizacion_moneda != 'USD'){
                $this->verTotalFactura = $factura->organizacion_moneda.' '.$factura->factura_total;
            }else{
                $dolar = getDollar();
                $this->verTotalFactura = $factura->organizacion_moneda.' '.$factura->factura_total.' / BS '.formatoMillares($factura->factura_total * $dolar);
            }
            if ($factura->pagos_id){
                if ($factura->pago->estatus == 2){
                    $this->pagos_id = $factura->pagos_id;
                }
            }
        }
    }

    #[On('initSelectBanco')]
    public function initSelectBanco()
    {
        //JS
    }

    #[On('getSelectBanco')]
    public function getSelectBanco($id)
    {
        $banco = Banco::find($id);
        if ($banco){
            $this->bancos_id = $banco->id;
            $this->nombre = $banco->nombre;
            $this->codigo = $banco->codigo;
        }
    }

    #[On('cerrarFormRegistro')]
    public function cerrarFormRegistro()
    {
        //JS
    }

    protected function dataClientes()
    {
        $clientes = Cliente::orderBy('nombre', 'ASC')->get();
        $data = array();
        foreach ($clientes as $row){
            $option = [
                'id' => $row->id,
                'text' => mb_strtoupper($row->cedula." | ".$row->nombre." ".$row->apellido)
            ];
            $data[] = $option;
        }
        $this->dispatch('initSelectCliente', data: $data);
    }

    protected function getFacturasCliente($id): array
    {
        $data = array();
        $facturas = Factura::where('clientes_id', $id)
            ->orderBy('factura_fecha', 'DESC')
            ->get();

        foreach ($facturas as $factura){

            if (is_null($factura->pagos_id)){
                $option = [
                    'id' => $factura->id,
                    'text' => strtoupper($factura->factura_numero.' | '.$factura->plan_etiqueta .' ('. mesEspanol(getFecha($factura->factura_fecha, 'm')) .')'),
                ];
                $data[] = $option;
            }else{
                $pago = Pago::find($factura->pagos_id);
                if ($pago->estatus == 2){
                    $pago = Pago::find($factura->pagos_id);
                    if ($pago->estatus == 2){
                        $option = [
                            'id' => $factura->id,
                            'text' => strtoupper($factura->factura_numero.' | '.$factura->plan_etiqueta .' ('. mesEspanol(getFecha($factura->factura_fecha, 'm')) .')'),
                        ];
                        $data[] = $option;
                    }
                }
            }
        }

        return $data;
    }

    protected function getMetodos()
    {
        $this->listarMetodos = Metodo::all();
    }

    protected function getBancos()
    {
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initSelectBanco', data: $data);
    }





}
