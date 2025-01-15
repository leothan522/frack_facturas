<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ClientesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        return view("dashboard.clientes.index");
    }

    public function export()
    {
        return \Excel::download(new ClientesExport(), "Clientes_Registrados_".date('d-m-Y').".xlsx");
    }
}
