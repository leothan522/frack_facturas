<?php

namespace App\Livewire\Web;

use App\Models\Banco;
use App\Models\Factura;
use App\Models\Metodo;
use App\Models\Pago;
use App\Models\Parametro;
use App\Models\Servicio;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ConsultarComponent extends Component
{
    use LivewireAlert;

    public $rows = 0, $numero = 6;
    public $servicio, $facturas;
    public $display = "verMetodos", $displayDetalles, $titleModal = "¿Cómo vas a pagar?";
    public $datosTransferencia, $datosPagoMovil, $datosZelle;
    public $titular, $cuenta, $cedula, $tipo, $banco, $monto, $totalFactura, $telefono, $email;
    public $referencia, $idBanco, $fecha, $moneda = 'Bs', $codigoBanco;
    public $verMetodo, $verEstatus, $estatus, $montoPago;

    #[Locked]
    public $cliente, $facturas_id, $rowquid, $pagos_id, $metodos_id;

    public function mount()
    {
        $this->cliente = session('cliente');
        $this->rows = $this->numero;
    }

    public function render()
    {
        $this->servicio = Servicio::where('clientes_id', $this->cliente['id'])->first();

        $this->facturas = Factura::where('clientes_id', $this->cliente['id'])
            ->orderBy('factura_fecha', 'DESC')
            ->limit($this->rows)
            ->get();

        return view('livewire.web.consultar-component');
    }

    public function setLimit()
    {
        $this->rows = $this->rows + $this->numero;
    }

    public function limpiar()
    {
        $this->reset([
            'display', 'displayDetalles', 'titleModal',
            'datosTransferencia', 'datosPagoMovil', 'datosZelle',
            'titular', 'cuenta', 'cedula', 'tipo', 'banco', 'monto', 'codigoBanco',
            'telefono', 'email',
            'facturas_id', 'rowquid', 'pagos_id', 'metodos_id',
            'referencia', 'idBanco', 'fecha', 'moneda', 'verMetodo', 'verEstatus', 'estatus', 'montoPago'
        ]);
        $this->resetErrorBag();
    }

    #[On('cerrarSesion')]
    public function cerrarSesion()
    {
        session()->forget('cliente');
        $this->redirect('cliente');
    }

    public function initModal($rowquid)
    {
        $this->limpiar();
        $factura = $this->getFactura($rowquid);
        if ($factura){

            $this->rowquid = $rowquid;
            $this->facturas_id = $factura->id;
            $this->totalFactura = $factura->factura_total;
            if ($factura->pagos_id){
                //consulto los datos del pago
                $pago = Pago::find($factura->pagos_id);
                $this->pagos_id = $pago->id;
                $this->monto = $pago->monto;
                $this->moneda = $pago->moneda;
                $this->verMetodo = getMetodoPago($pago->metodo);

                $this->referencia = $pago->referencia;
                $this->banco = $pago->nombre;
                $this->fecha = getFecha($pago->fecha);
                if ($pago->estatus == 0){
                    $this->estatus = 0;
                    $this->verEstatus = "Esperando Validación";
                }
                if ($pago->estatus == 1){
                    $this->estatus = 1;
                    $this->verEstatus = "Validado";
                }
                if ($pago->estatus == 2){
                    $this->estatus = 2;
                    $this->verEstatus = "NO Validado (Revisar)";
                }
                $this->titleModal = "Ver Pago";
                $this->display = "verPago";
            }else {
                $this->datosTransferencia = Metodo::where('metodo', 'transferencia')->first();
                $this->datosPagoMovil = Metodo::where('metodo', 'movil')->first();
                $this->datosZelle = Metodo::where('metodo', 'zelle')->first();
            }

        }

    }

    public function verDetalles($metodo)
    {
        $this->monto = $this->getMontoBs();
        switch ($metodo){
            case "movil":
                $this->titleModal = "Pago móvil";
                $this->telefono = $this->datosPagoMovil->telefono;
                $explode = explode('-', $this->datosPagoMovil->cedula);
                $this->cedula = $explode[0] . $explode[1];
                $this->banco = $this->datosPagoMovil->banco->nombre;
                $this->codigoBanco = $this->datosPagoMovil->banco->codigo;
                $this->metodos_id = $this->datosPagoMovil->id;
                $this->displayDetalles = "movil";
                break;
            case "zelle":
                $this->titleModal = "Zelle";
                $this->titular = $this->datosZelle->titular;
                $this->email = $this->datosZelle->email;
                $this->metodos_id = $this->datosZelle->id;
                $this->moneda = 'USD';
                $this->monto = $this->totalFactura;
                $this->displayDetalles = "zelle";
                break;
            default:
                $this->titleModal = "Transferencia";
                $this->titular = $this->datosTransferencia->titular;
                $this->cuenta = $this->datosTransferencia->cuenta;
                $explode = explode('-', $this->datosTransferencia->cedula);
                $this->cedula = $explode[0] . $explode[1];
                $this->tipo = $this->datosTransferencia->tipo;
                $this->banco = $this->datosTransferencia->banco->nombre;
                $this->metodos_id = $this->datosTransferencia->id;
                $this->displayDetalles = "transferencia";
                break;
        }
        $this->display = "verDetalles";
    }

    protected function getFactura($rowquid): ?Factura
    {
        return Factura::where('rowquid', $rowquid)->first();
    }

    protected function getMontoBs(): float
    {
        $dolar = getDollar();
        return $this->totalFactura * $dolar;
    }

    public function btnRegistrar()
    {
        $this->titleModal = "Registrar Pago";
        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initBanco', data: $data);
        $this->display = "verForm";
    }

    public function save()
    {
        $rules = [
            'referencia' => ['required', 'alpha_num', 'min:8', 'max:15', Rule::unique('pagos', 'referencia')->ignore($this->pagos_id)],
            //'idBanco' => "required",
            'idBanco' => Rule::requiredIf($this->displayDetalles != "zelle"),
            'fecha' => 'required',
            'montoPago' => 'required|numeric'
        ];
        $messages = [
            'idBanco.required' => 'El campo banco es obligatorio.',
        ];
        $this->validate($rules, $messages);

        if ($this->pagos_id){
            $pago = Pago::find($this->pagos_id);
        }else{
            $pago = new Pago();
        }

        if ($pago){

            $factura = Factura::find($this->facturas_id);

            if (is_null($factura->pagos_id)){

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
                if ($this->idBanco){
                    $banco = Banco::find($this->idBanco);
                    $pago->nombre = $banco->nombre;
                    $pago->codigo = $banco->codigo;
                }
                $pago->dollar = getDollar();
                $pago->clientes_id = $this->cliente['id'];
                $pago->facturas_id = $this->facturas_id;

                do{
                    $rowquid = generarStringAleatorio(16);
                    $existe = Pago::where('rowquid', $rowquid)->first();
                }while($existe);
                $pago->rowquid = $rowquid;
                $pago->save();


                $factura->pagos_id = $pago->id;
                $factura->save();

                $this->dispatch('cerrarModal');

                $this->alert('success', '¡Pago Registrado!', [
                    'position' => 'center',
                    'timer' => '',
                    'toast' => false,
                    'text' => 'Recibimos los datos del pago y lo estamos verificando. Este proceso puede demorar hasta 30 minutos.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'OK',
                ]);

            }else{
                $this->dispatch('cerrarModal');
            }

        }

    }

    #[On('initBanco')]
    public function initBanco($data)
    {
        //JS
    }

    #[On('getBanco')]
    public function getBanco($rowquid)
    {
        $this->idBanco = $rowquid;
    }

    #[On('setBanco')]
    public function setBanco($rowquid)
    {
        //JS
    }
    #[On('cerrarModal')]
    public function cerrarModal()
    {
        //JS
    }

    public function corregirPago()
    {
        $pago = Pago::find($this->pagos_id);
        $pago->delete();
        $this->initModal($this->rowquid);
    }

    #[On('pegarReferencia')]
    public function pegarReferencia($referencia)
    {
        if (is_numeric($referencia)){
            $this->referencia = $referencia;
        }
    }

}
