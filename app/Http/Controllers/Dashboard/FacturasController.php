<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    public function index()
    {
        return view('dashboard.facturas.index');
    }

    public function exportFactura($rowquid)
    {
        $factura = Factura::where('rowquid', $rowquid)->first();
        if ($factura){
            return getPdfFactura($factura);
        }else{
            return redirect()->route('facturas.index');
        }
    }
}
