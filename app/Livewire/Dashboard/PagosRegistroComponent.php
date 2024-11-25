<?php

namespace App\Livewire\Dashboard;

use App\Mail\ValidacionPagoMail;
use App\Models\Banco;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Metodo;
use App\Models\Pago;
use App\Models\Parametro;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class PagosRegistroComponent extends Component
{

    use LivewireAlert;

    public $titlePago = "Registrar Pago", $displayPago = "verCliente", $estatusPago, $displayDetalles;
    public $datosTransferencia, $datosPagoMovil, $datosZelle;
    public $referenciaPago, $idBanco, $fechaPago, $monedaPago = 'Bs', $codigoBanco, $montoPago;
    public $listarFacturas, $cliente, $bolivares;
    public $monto, $banco, $moneda = "Bs";

    #[Locked]
    public $clientes_id, $metodos_id, $factura;

    public function render()
    {
        return view('livewire.dashboard.pagos-registro-component');
    }

    public function limpiar()
    {
        $this->reset([
            'titlePago', 'displayPago', 'estatusPago', 'displayDetalles',
            'datosTransferencia', 'datosPagoMovil', 'datosZelle',
            'referenciaPago', 'idBanco', 'monedaPago', 'codigoBanco', 'montoPago', 'fechaPago',
            'listarFacturas', 'cliente', 'clientes_id', 'metodos_id', 'factura', 'bolivares',
        ]);

        $this->resetErrorBag();
    }

    #[On('initRegistrarPago')]
    public function initRegistrarPago()
    {
        $this->limpiar();
        $clientes = Cliente::orderBy('nombre', 'ASC')->get();
        $data = array();
        foreach ($clientes as $row){
            $option = [
                'id' => $row->id,
                'text' => mb_strtoupper($row->cedula." | ".$row->nombre." ".$row->apellido)
            ];
            $data[] = $option;
        }
        $this->dispatch('initCliente', data: $data);

    }

    public function verMetodos($rowquid)
    {
        $factura = $this->getFactura($rowquid);
        if ($factura) {
            $this->factura = $factura;
            $this->bolivares = $this->getMontoBs($factura->factura_total);
            $this->datosTransferencia = Metodo::where('metodo', 'transferencia')->first();
            $this->datosPagoMovil = Metodo::where('metodo', 'movil')->first();
            $this->datosZelle = Metodo::where('metodo', 'zelle')->first();
            $this->displayPago = "verMetodos";
        }
    }

    public function verDetalles($metodo)
    {
        switch ($metodo){
            case "movil":
                $this->titlePago = "Pago móvil";
                $this->banco = $this->datosPagoMovil->banco->nombre;
                $this->codigoBanco = $this->datosPagoMovil->banco->codigo;
                $this->metodos_id = $this->datosPagoMovil->id;
                $this->displayDetalles = "movil";
                break;
            case "zelle":
                $this->titlePago = "Zelle";
                $this->metodos_id = $this->datosZelle->id;
                $this->moneda = 'USD';
                $this->monedaPago = 'USD';
                $this->displayDetalles = "zelle";
                break;
            default:
                $this->titlePago = "Transferencia";
                $this->banco = $this->datosTransferencia->banco->nombre;
                $this->metodos_id = $this->datosTransferencia->id;
                $this->displayDetalles = "transferencia";
                break;
        }

        $bancos = Banco::all();
        $data = getDataSelect2($bancos, 'nombre', 'id');
        $this->dispatch('initBanco', data: $data);

        $this->displayPago = "verForm";
    }

    public function savePago()
    {
        $rules = [
            'referenciaPago' => ['required', 'alpha_num', 'min:8', 'max:15', Rule::unique('pagos', 'referencia')->ignore($this->factura->pagos_id)],
            //'idBanco' => "required",
            'idBanco' => Rule::requiredIf($this->displayDetalles != "zelle"),
            'fechaPago' => 'required',
            'montoPago' => 'required|numeric'
        ];
        $messages = [
            'idBanco.required' => 'El campo banco es obligatorio.',
        ];
        $this->validate($rules, $messages);

        $factura = Factura::find($this->factura->id);

        if ($factura) {

            if (is_null($factura->pagos_id)){
                $pago = new Pago();
            }else{
                $pago = Pago::find($factura->pagos_id);
            }

            if ($pago){
                $metodo = Metodo::find($this->metodos_id);
                $pago->referencia = $this->referenciaPago;
                $pago->fecha = $this->fechaPago;
                $pago->monto = $this->montoPago;
                $pago->moneda = $this->monedaPago;
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
                $pago->clientes_id = $this->cliente;
                $pago->facturas_id = $factura->id;
                $pago->estatus = 1;
                $pago->factura_numero = $factura->factura_numero;

                do{
                    $rowquid = generarStringAleatorio(16);
                    $existe = Pago::where('rowquid', $rowquid)->first();
                }while($existe);
                $pago->rowquid = $rowquid;
                $pago->save();


                $factura->pagos_id = $pago->id;
                $factura->estatus = 1;
                $factura->save();

                $this->sendEmail($pago->id);

                $this->dispatch('actualizar')->to(PagosComponent::class);

                $this->dispatch('cerrarModalPago');

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
                $this->dispatch('cerrarModalPago');
            }
        }else{
            $this->dispatch('cerrarModalPago');
        }
    }

    #[On('initCliente')]
    public function initCliente($data)
    {
        //JS
    }

    #[On('getCliente')]
    public function getCliente($rowquid)
    {
        $this->cliente = $rowquid;
        $this->listarFacturas = $this->getFacturas($this->cliente);
    }

    #[On('setCliente')]
    public function setCliente($rowquid)
    {
        //JS
    }

    protected function getFacturas($clientes_id): array
    {
        $data = [];
        $facturas = Factura::where('clientes_id', $clientes_id)
            ->orderBy('factura_fecha', 'DESC')
            ->get();

        foreach ($facturas as $factura){

            if (is_null($factura->pagos_id)){
                $data[] = [
                    'rowquid' => $factura->rowquid,
                    'numero' => $factura->factura_numero,
                    'montoDollar' => $factura->factura_total,
                    'montoBs' => $this->getMontoBs($factura->factura_total),
                ];
            }else{
                $pago = Pago::find($factura->pagos_id);
                if ($pago->estatus == 2){
                    $data[] = [
                        'rowquid' => $factura->rowquid,
                        'numero' => $factura->factura_numero,
                        'montoDollar' => $factura->factura_total,
                        'montoBs' => $this->getMontoBs($factura->factura_total),
                    ];
                }
            }

        }

        return $data;
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

    #[On('cerrarModalPago')]
    public function cerrarModalPago()
    {
        //JS
    }

    protected function getMontoBs($monto): float
    {
        $dolar = getDollar();
        return $monto * $dolar;
    }

    protected function getFactura($rowquid): ?Factura
    {
        return Factura::where('rowquid', $rowquid)->first();
    }

    #[On('pegarReferencia')]
    public function pegarReferencia($referencia)
    {
        if (is_numeric($referencia)){
            $this->referenciaPago = $referencia;
        }
    }

    protected function sendEmail($id)
    {
        $pago = Pago::find($id);
        if ($pago) {
            $data = [
                'from_email' => getCorreoSistema(),
                'from_name' => config('app.name'),
                'subject' => 'Información sobre tu Pago',
                'estatus' => $pago->estatus,
                'cliente_nombre' => strtoupper($pago->cliente->nombre.' '.$pago->cliente->apellido),
                'factura_mes' => strtoupper(mesEspanol(getFecha($pago->factura->factura_fecha, "m"))),
                'factura_year' => getFecha($pago->factura->factura_fecha, "Y"),
                'pago_metodo' => getMetodoPago($pago->metodo),
                'pago_referencia' => strtoupper($pago->referencia),
                'pago_banco' => $pago->nombre,
                'pago_moneda' => $pago->moneda,
                'pago_monto' => formatoMillares($pago->monto),
                'pago_fecha' => getFecha($pago->fecha),
                'email' => getCorreoSistema(),
                'telefono' => getTelefonoSistema()
            ];
            $to = $pago->cliente->email;
            Mail::to($to)->send(new ValidacionPagoMail($data));
        }
    }

}
