<?php

namespace App\Livewire\Dashboard;

use App\Mail\ValidacionPagoMail;
use App\Models\Factura;
use App\Models\Pago;
use App\Traits\MailBox;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PagosComponent extends Component
{
    use ToastBootstrap;
    use MailBox;

    #[Locked]
    public $rowquid;

    public function render()
    {
        $listar = Pago::buscar($this->keyword)
            ->orderBy('factura', $this->order)
            ->paginate(numRowsPaginate());
        $rows = Pago::buscar($this->keyword)->count();

        return view('livewire.dashboard.pagos-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function btnSI()
    {
        $this->validarPago(1);
    }

    public function btnNO()
    {
        $this->validarPago(2);
    }

    protected function validarPago($estatus)
    {
        $pago = Pago::find($this->pagos_id);
        $pago->estatus = $estatus;
        $pago->save();


        if ($estatus == 1){
            $factura = Factura::find($pago->facturas_id);
            $factura->estatus = 1;
            $factura->save();
        }

        $this->sendEmail($pago->id);
        $this->show($pago->rowquid);
        $this->toastBootstrap();
    }

    public function btnReset()
    {
        $this->confirmToastBootstrap('resetPago', [
            'button' => "¡Sí, restablacer!",
            'message' => "¡Si restableces el pago, su estatus cambiara a Esperando Validación!"
        ]);
    }

    #[On('resetPago')]
    public function resetPago()
    {
        $pago = Pago::find($this->pagos_id);
        $pago->estatus = 0;
        $pago->save();

        $factura = Factura::find($pago->facturas_id);
        $factura->estatus = 0;
        $factura->save();

        $this->show($pago->rowquid);
        $this->toastBootstrap('info', 'Pago Reestablecido.');
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
