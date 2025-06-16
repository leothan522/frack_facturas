<?php

namespace App\Console\Commands;

use App\Mail\AvisoCorteMail;
use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Parametro;
use App\Traits\Facturas;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FacturarAutomatico extends Command
{
    use Facturas;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facturar:automatico';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Facturas Generadas Automaticamente.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $parametro = Parametro::where('nombre', '=', 'facturar_automatico')
            ->where('valor', '=', 1)
            ->first();
        if ($parametro){
            $this->generarFacturas();
        }
        $this->avisoDeCorteTrait();
    }

    protected function generarFacturas()
    {
        $orderServicios = $this->getServiciosTrait();
        foreach ($orderServicios as $servicio){
            $factura = $this->createFacturaTrait($servicio['id'], $servicio['fecha']);
            if ($factura){
                $this->sendFacturaTrait($this->facturaRowquid);
            }
        }
    }

}
