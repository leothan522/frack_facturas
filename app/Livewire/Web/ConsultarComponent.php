<?php

namespace App\Livewire\Web;

use App\Models\Banco;
use App\Models\Factura;
use App\Models\Metodo;
use App\Models\Pago;
use App\Models\Servicio;
use App\Traits\Facturas;
use App\Traits\ToastBootstrap;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ConsultarComponent extends Component
{
    use ToastBootstrap;
    use Facturas;

    public $size = 145, $rows = 13, $ocultarFacturas = false, $facturas;
    public $collapseServicio = false, $collapseSoporte = false, $collapseFacturas = false;
    public $verPlanServicio = false, $verCodigo, $verOrganizacion, $verPlan, $verBajada, $verSubida, $verPrecio;
    public $verTelefono, $verEmail;
    public $classEstatus, $estatusPago, $verEstatus, $verMetodo, $verReferencia, $verBanco, $verMoneda, $verMonto, $verFecha, $verFactura;
    public $datosTransferencia, $datosPagoMovil, $datosZelle, $footer = false, $display = "verMetodos", $metodo = 'transferencia';
    public $totalFactura, $titular, $cuenta, $cedula, $tipo, $banco, $monto, $telefono, $email;

    public $referencia, $fecha, $montoPago, $moneda = 'Bs', $bancos_id,  $codigoBanco;

    #[Locked]
    public $cliente, $pagos_id, $rowquid, $metodos_id;

    public array $icono = [
        0 => '<i class="fas fa-exclamation-circle text-primary"></i>',
        1 => '<i class="fas fa-check-circle text-success"></i>',
        2 => '<i class="fas fa-exclamation-triangle text-danger"></i>',
    ];

    public function mount()
    {
        $this->cliente = session('cliente');
    }

    public function render()
    {
        $this->getServicio();
        $this->getSoporte();
        $this->getFacturas();
        return view('livewire.web.consultar-component');
    }

    public function limpiar()
    {
        $this->reset([
            'ocultarFacturas',
            'datosTransferencia', 'datosPagoMovil', 'datosZelle', 'footer', 'display', 'metodo',
            'totalFactura', 'titular', 'cuenta', 'cedula', 'tipo', 'banco', 'monto', 'telefono', 'email',
            'referencia', 'fecha', 'montoPago', 'moneda', 'bancos_id',  'codigoBanco',
            'pagos_id', 'metodos_id',
        ]);
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'referencia' => ['required', 'alpha_num', 'min:8', 'max:15', Rule::unique('pagos', 'referencia')->ignore($this->pagos_id)],
            'bancos_id' => Rule::requiredIf($this->metodo != "zelle"),
            'fecha' => 'required',
            'montoPago' => 'required|numeric'
        ];
        $messages = [
            'bancos_id.required' => 'El campo banco es obligatorio.',
        ];
        $this->validate($rules, $messages);

        if ($this->pagos_id){
            $pago = Pago::find($this->pagos_id);
        }else{
            $pago = new Pago();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Pago::where('rowquid', $rowquid)->first();
            }while($existe);
            $pago->rowquid = $rowquid;
        }

        if ($pago){

            $factura = $this->getFactura($this->rowquid);

            if ($factura && is_null($factura->pagos_id)){

                $metodo = Metodo::find($this->metodos_id);
                $pago->referencia = $this->referencia;
                $pago->fecha = $this->fecha;
                $pago->monto = $this->montoPago;
                $pago->moneda = $this->moneda;
                $pago->metodo = $metodo->metodo;
                $pago->titular = $metodo->titular;
                $pago->cuenta = $metodo->cuenta;
                $pago->tipo = $metodo->tipo;
                $pago->cedula = $metodo->cedula;
                $pago->telefono = $metodo->telefono;
                $pago->email = $metodo->email;
                if ($this->bancos_id){
                    $banco = Banco::find($this->bancos_id);
                    $pago->nombre = $banco->nombre;
                    $pago->codigo = $banco->codigo;
                }
                $pago->dollar = getDollar();
                $pago->clientes_id = $this->cliente['id'];
                $pago->facturas_id = $factura->id;
                $pago->factura_numero = $factura->factura_numero;
                $pago->save();


                $factura->pagos_id = $pago->id;
                $factura->save();

                $html = '
                    <div class="row">
                        <div class="col-12 p-2">
                            <div class="small-box" style="box-shadow: none; min-height: 40px;">
                                <div class="overlay bg-light">
                                    <i class="far fa-4x fa-lightbulb opacity-75 text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-justify">
                            Recibimos los datos del pago y lo estamos verificando. Este proceso puede demorar hasta 30 minutos.
                        </div>
                    </div>
                ';

                $this->htmlToastBoostrap(null, null, [
                    'type' => 'success',
                    'title' => "¡Pago Registrado!",
                    'message' => $html
                ]);

            }

            $this->limpiar();

        }

    }

    public function btnPagar($rowquid)
    {
        $this->limpiar();
        $factura = $this->getFactura($rowquid);
        if ($factura){
            $this->ocultarFacturas = true;
            $this->getMetodos();
            $this->rowquid = $factura->rowquid;
            $this->totalFactura = $factura->factura_total;
        }
    }

    public function verDetalles($metodo)
    {
        $this->monto = $this->getMontoBs();
        switch ($metodo){
            case "movil":
                $this->telefono = $this->datosPagoMovil->telefono;
                $explode = explode('-', $this->datosPagoMovil->cedula);
                $this->cedula = $explode[0] . $explode[1];
                $this->banco = $this->datosPagoMovil->banco->nombre;
                $this->codigoBanco = $this->datosPagoMovil->banco->codigo;
                $this->metodos_id = $this->datosPagoMovil->id;
                break;
            case "zelle":
                $this->titular = $this->datosZelle->titular;
                $this->email = $this->datosZelle->email;
                $this->moneda = 'USD';
                $this->monto = $this->totalFactura;
                $this->metodos_id = $this->datosZelle->id;
                break;
            default:
                $this->titular = $this->datosTransferencia->titular;
                $this->cuenta = $this->datosTransferencia->cuenta;
                $explode = explode('-', $this->datosTransferencia->cedula);
                $this->cedula = $explode[0] . $explode[1];
                $this->tipo = $this->datosTransferencia->tipo;
                $this->banco = $this->datosTransferencia->banco->nombre;
                $this->metodos_id = $this->datosTransferencia->id;
                break;
        }
        $this->metodo = $metodo;
        $this->display = "verDetalles";
        $this->footer = true;
    }

    public function btnVolver()
    {
        $this->btnPagar($this->rowquid);
    }

    public function btnRegistrarPago()
    {
        $this->getBancos();
        $this->display = "verForm";
    }

    public function cancel()
    {
        $this->limpiar();
    }

    public function showFactura($rowquid, $option)
    {
        $factura = $this->getFactura($rowquid);
        if ($factura){
            $this->dispatch('initFactura', rowquid: $rowquid, option: $option);
        }
    }

    public function btnVerPDF($rowquid)
    {
        $this->showPdfFacturaTrait($rowquid);
    }

    public function btnVerPago($rowquid)
    {
        $this->limpiar();
        $pago = Pago::where('rowquid', $rowquid)->first();
        if ($pago){
            $this->pagos_id = $pago->id;
            $this->verMetodo = getMetodoPago($pago->metodo);
            $this->verReferencia = $pago->referencia;
            if ($pago->metodo != "zelle"){
                $this->verBanco = $pago->nombre;
            }
            $this->verMoneda = $pago->moneda;
            $this->verMonto = formatoMillares($pago->monto);
            $this->verFecha = getFecha($pago->fecha);
            $this->estatusPago = $pago->estatus;
            if ($pago->estatus == 0){
                $this->classEstatus = 'text-primary';
                $this->verEstatus = $this->icono[$pago->estatus]." Esperando Validación";
            }
            if ($pago->estatus == 1){
                $this->classEstatus = 'text-success';
                $this->verEstatus = $this->icono[$pago->estatus]." Validado";
            }
            if ($pago->estatus == 2){
                $this->classEstatus = 'text-danger';
                $this->verEstatus = $this->icono[$pago->estatus]." NO Validado (Revisar)";
            }
            $this->verFactura = $pago->factura_numero;
            $this->dispatch('initVerPago', rowquid: $rowquid);
        }
    }

    public function btnCorregirPago()
    {
        $pago = Pago::find($this->pagos_id);
        if ($pago){
            $factura = Factura::find($pago->facturas_id);
            $factura->pagos_id = null;
            $factura->save();
            $pago->delete();
            $this->btnPagar($factura->rowquid);
        }else{
            $this->limpiar();
        }
    }

    public function setCollapseCard($option = null)
    {
        switch ($option){
            case 'soporte':
                if ($this->collapseSoporte){
                    $this->collapseSoporte = false;
                }else{
                    $this->collapseSoporte = true;
                }
                break;
            case 'facturas':
                if ($this->collapseFacturas){
                    $this->collapseFacturas = false;
                }else{
                    $this->collapseFacturas = true;
                }
                break;
            default:
                if ($this->collapseServicio){
                    $this->collapseServicio = false;
                }else{
                    $this->collapseServicio = true;
                }
                break;
        }
    }

    public function actualizarServicio()
    {
        //refresh
    }

    public function actualizarSoporte()
    {
        //refresh
    }

    public function actualizarFacturas()
    {
        //refresh
    }

    public function actualizarRegistroPago()
    {
        //refresh
    }

    #[On('initFactura')]
    public function initFactura($rowquid, $option)
    {
        //JS
    }

    #[On('initVerPago')]
    public function initVerPago($rowquid)
    {
        //JS
    }

    #[On('initSelectBancos')]
    public function initSelectBancos($data)
    {
        //JS
    }

    #[On('getSelectBancos')]
    public function getSelectBancos($id)
    {
        $this->bancos_id = $id;
    }

    #[On('setSelectBancos')]
    public function setSelectBancos($id)
    {
        //JS
    }

    #[On('pegarReferencia')]
    public function pegarReferencia($referencia)
    {
        $this->referencia = $referencia;
    }

    #[On('cerrarSesion')]
    public function cerrarSesion()
    {
        session()->forget('cliente');
        $this->redirect('cliente');
    }

    protected function getServicio()
    {
        $servicio = Servicio::where('clientes_id', $this->cliente['id'])->first();
        if ($servicio){
            $this->verPlanServicio = true;
            $this->verCodigo = $servicio->codigo;
            $this->verOrganizacion = $servicio->organizacion->nombre;
            $this->verPlan = $servicio->plan->etiqueta_factura;
            $this->verBajada = $servicio->plan->bajada." Mbps.";
            $this->verSubida = $servicio->plan->subida." Mbps.";
            $this->verPrecio = $servicio->organizacion->moneda." ".formatoMillares($servicio->plan->precio);
        }
    }

    protected function getSoporte()
    {
        $this->verTelefono = getTelefonoSistema();
        $this->verEmail = getCorreoSistema();
    }

    protected function getFacturas()
    {
        $this->facturas = Factura::where('clientes_id', $this->cliente['id'])
            ->orderBy('factura_fecha', 'DESC')
            ->limit($this->rows)
            ->get();
        $this->facturas->each(function ($factura){
            if ($factura->pagos_id){
                if ($factura->pago->estatus == 0){
                    $factura->cardClase = "card-primary";
                }
                if ($factura->pago->estatus == 1){
                    $factura->cardClase = "card-success";
                }
                if ($factura->pago->estatus == 2){
                    $factura->cardClase = "card-danger";
                }
            }else{
                $factura->cardClase = "card-danger";
            }
            $factura->plan_servicio = $factura->plan_etiqueta .' ('. mesEspanol(getFecha($factura->factura_fecha, 'm')) .')';

        });
    }

    protected function getFactura($rowquid): ?Factura
    {
        return Factura::where('rowquid', $rowquid)->first();
    }

    protected function getBancos()
    {
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initSelectBancos', data: $data);
    }

    protected function getMetodos()
    {
        $this->datosTransferencia = Metodo::where('metodo', 'transferencia')->first();
        $this->datosPagoMovil = Metodo::where('metodo', 'movil')->first();
        $this->datosZelle = Metodo::where('metodo', 'zelle')->first();
    }

    protected function getMontoBs(): float
    {
        $dolar = getDollar();
        return $this->totalFactura * $dolar;
    }

}
