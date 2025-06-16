<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Pago;
use App\Models\Parametro;
use App\Traits\Facturas;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class FacturasComponent extends Component
{
    use ToastBootstrap;
    use MailBox;
    use Facturas;

    public $idFacturarAutomatico, $facturarAutomatico, $nuevasFacturas = 0, $verNuevasFacturas = false;
    public $send;
    public $organizacionActual = 0;
    public $verFacturasEnviadas = false, $facturasEnviadas = 0;

    public $verOrganizacion, $verFecha, $verCedula, $verCliente, $verPlan, $verTotal, $verBs, $classEstatus, $verEstatus;

    #[Locked]
    public $rowquid;

    public function mount()
    {
        $this->getFacturarAutomatico();
    }

    public function render()
    {
        if ($this->organizacionActual){
            $listar = Factura::buscar($this->keyword)
                ->where('organizaciones_id', $this->organizacionActual)
                ->orderBy('factura_fecha', $this->order)
                ->paginate(numRowsPaginate());
            $rows = Factura::buscar($this->keyword)
                ->where('organizaciones_id', $this->organizacionActual)
                ->count();
        }else{
            $listar = Factura::buscar($this->keyword)
                ->orderBy('factura_fecha', $this->order)
                ->paginate(numRowsPaginate());
            $rows = Factura::buscar($this->keyword)->count();
        }
        return view('livewire.dashboard.facturas-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function getFacturarAutomatico()
    {
        $this->reset(['idFacturarAutomatico', 'facturarAutomatico']);
        $parametro = Parametro::where('nombre', '=', 'facturar_automatico')->first();
        if ($parametro){
            $this->idFacturarAutomatico = $parametro->id;
            $this->facturarAutomatico = $parametro->valor;
        }
    }

    public function setFacturarAutomatico()
    {
        if (!$this->facturarAutomatico){
            $this->facturarAutomatico = 1;
        }else{
            $this->facturarAutomatico = 0;
        }

        if ($this->idFacturarAutomatico){
            //editar
            $parametro = Parametro::find($this->idFacturarAutomatico);
        }else{
            //nuevo
            $parametro = new Parametro();
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', $rowquid)->first();
            }while($existe);
            $parametro->rowquid = $rowquid;
        }

        if ($parametro){
            $parametro->nombre = 'facturar_automatico';
            $parametro->valor = $this->facturarAutomatico;
            $parametro->save();
            $this->idFacturarAutomatico = $parametro->id;
        }

    }

    public function show($rowquid)
    {
        $this->reset([
            'send', 'verOrganizacion', 'verFecha', 'verCedula', 'verCliente', 'verPlan', 'verTotal', 'verBs', 'classEstatus', 'verEstatus',
        ]);

        $factura = Factura::where('rowquid', $rowquid)->first();
        if ($factura) {

            $this->facturaNumero = $factura->factura_numero;
            $this->rowquid = $factura->rowquid;
            $this->send = $factura->send;

            $this->verOrganizacion = $factura->organizacion_nombre;
            $this->verFecha = getFecha($factura->factura_fecha);
            $this->verCedula = formatoMillares($factura->cliente_cedula, 0);
            $this->verCliente = $factura->cliente_nombre." ".$factura->cliente_apellido;
            $this->verPlan = $factura->plan_etiqueta .' ('. mesEspanol(getFecha($factura->factura_fecha, 'm')) .')';
            $this->verTotal = $factura->organizacion_moneda." ".$factura->factura_total;
            if ($factura->pagos_id){
                $estatus = $factura->pago->estatus;
                if ($estatus == 0){
                    $this->classEstatus = 'text-primary';
                    $this->verEstatus = $this->icono[$estatus]." Pago Esperando Validación";
                }
                if ($estatus == 1){
                    $this->classEstatus = 'text-success';
                    $this->verEstatus = $this->icono[$estatus]." Pago Validado";
                }
                if ($estatus == 2){
                    $this->classEstatus = 'text-danger';
                    $this->verEstatus = $this->icono[$estatus]." Pago NO Validado (Revisar)";
                }
            }

            $this->dispatch('initModal');

        }

    }

    public function btnVerPDF()
    {
        $this->showPdfFacturaTrait($this->rowquid);
    }

    public function btnSendFactura()
    {
        $send = $this->sendFacturaTrait($this->rowquid);
        if ($send){
            $this->show($this->rowquid);
            $nombre = '<b class="text-uppercase text-warning">'.$this->facturaNumero.'</b>';
            $this->toastBootstrap('info', "Factura $nombre Enviada.");
        }
    }

    public function btnGenerarFacturas()
    {
        $this->reset(['nuevasFacturas', 'verNuevasFacturas']);
        $orderServicios = $this->getServiciosTrait();
        foreach ($orderServicios as $servicio){
            $factura = $this->createFacturaTrait($servicio['id'], $servicio['fecha']);
            if ($factura){
                $this->nuevasFacturas++;
            }
        }
        $this->verNuevasFacturas = true;
    }

    public function getOrganizacion($id = null)
    {
        $data[0] = "Todos";
        $organizaciones = Organizacion::orderBy('nombre', 'ASC')->get();
        foreach ($organizaciones as $organizacion){
            $data[$organizacion->id] = $organizacion->nombre;
        }
        if (!is_null($id)){
            return $data[$id];
        }else{
            return $data;
        }
    }

    public function btnFiltro($key)
    {
        $this->organizacionActual = $key;
    }

    public function btnSendFacturas()
    {
        $this->reset(['verFacturasEnviadas', 'facturasEnviadas']);
        $facturas = Factura::where('send', 0)
            ->orderBy('factura_fecha', 'ASC')
            ->get();
        foreach ($facturas as $factura){
            $send = $this->sendFacturaTrait($factura->rowquid);
            if ($send){
                $factura->send = 1;
                $factura->save();
                $this->facturasEnviadas++;
            }
        }
        $this->verFacturasEnviadas = true;
    }

    #[On('delete')]
    public function delete()
    {
        $registro = Factura::where('rowquid', $this->rowquid)->first();
        if ($registro){

            //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
            $vinculado = false;

            $pagos = Pago::where('facturas_id', $registro->id)->first();
            if ($pagos){
                $vinculado = true;
            }

            if ($vinculado) {
                $this->htmlToastBoostrap();
            } else {
                $nombre = '<b class="text-uppercase text-warning">'.$registro->factura_numero.'</b>';
                $registro->delete();
                $this->dispatch('confirmedDelete');
                $this->actualizar();
                $this->toastBootstrap('success', "Factura $nombre Eliminada.");
            }

        }
    }

    #[On('reeviarFactura')]
    public function btnReenviar()
    {
        $this->btnSendFactura();
    }

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        //JS
    }

    #[On('initModal')]
    public function initModal()
    {
        //JS
    }

}
