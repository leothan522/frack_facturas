<?php

namespace App\Console\Commands;

use App\Models\Parametro;
use Illuminate\Console\Command;

class FacturarAutomatico extends Command
{
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
        $parametro = Parametro::where('nombre', '=', 'facturar_automatico')->where('valor', '=', 1)->first();
        if ($parametro){
            $parametro = new Parametro();
            $parametro->nombre = "prueba";
            $parametro->tabla_id = 1;
            $parametro->valor = "hola mundo";
            $parametro->save();
        }
    }
}
