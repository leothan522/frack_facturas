<?php

namespace App\Livewire\Dashboard;

use App\Models\Banco;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Metodo;
use App\Models\Pago;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\On;
use Livewire\Component;

class PagosRegistrarComponent extends Component
{
    use ToastBootstrap;

    public $title = "Registrar Pago";
    public int $size = 179; //max-height: 305px;
    public $clientes_id, $facturas_id;
    public $verOrganizacionFactura, $verNumeroFactura, $verFechaFactura, $verTotalFactura;
    public $listarMetodos, $ocultarBanco = true;

    public $metodo, $bancos_id, $referencia, $fecha, $monto;

    public function render()
    {
        $this->getMetodos();
        return view('livewire.dashboard.pagos-registrar-component');
    }

    public function limpiar()
    {
        $this->reset([
            'title', 'clientes_id', 'facturas_id',
            'verOrganizacionFactura', 'verNumeroFactura', 'verFechaFactura', 'verTotalFactura',
        ]);
        $this->reset();
        $this->dataClientes();
    }

    public function updatedMetodo()
    {
        if (!empty($this->metodo) && $this->metodo != 'zelle'){
            $this->ocultarBanco = false;
            $this->getBancos();
        }else{
            $this->ocultarBanco = true;
            $this->reset(['bancos_id']);
        }
    }

    #[On('initRegistrarPago')]
    public function initForm()
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
            $this->verOrganizacionFactura = $factura->organizacion->nombre;
            $this->verNumeroFactura = $factura->factura_numero;
            $this->verFechaFactura = getFecha($factura->factura_fecha);
            if ($factura->organizacion_moneda != 'USD'){
                $this->verTotalFactura = $factura->organizacion_moneda.' '.$factura->factura_total;
            }else{
                $dolar = getDollar();
                $this->verTotalFactura = $factura->organizacion_moneda.' '.$factura->factura_total.' / BS '.formatoMillares($factura->factura_total * $dolar);
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
        $this->bancos_id = $id;
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
