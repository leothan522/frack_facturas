<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Traits\Facturas;

class FacturasController extends Controller
{
    use Facturas;

    public function index()
    {
        return view('dashboard.facturas.index');
    }

    public function exportFactura($rowquid)
    {
        $factura = Factura::where('rowquid', $rowquid)->first();
        if ($factura){
            return $this->getPdfFacturaTrait($factura);
        }else{
            return redirect()->route('facturas.index');
        }
    }
}
