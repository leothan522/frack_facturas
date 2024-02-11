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

    public function exportFactura($id)
    {
        $factura = Factura::find($id);
        $data = [
            'factura' => $factura
        ];
        $pdf = Pdf::loadView('dashboard._export.pdf_factura', $data);
        return $pdf->stream('factura.pdf');
    }
}
