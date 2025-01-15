<?php

namespace App\Exports;

use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClientesExport implements FromView, WithTitle, WithProperties, ShouldAutoSize
{

    public function view(): View
    {
        // TODO: Implement view() method.
        $clientes = Cliente::all();
        $clientes->each(function ($cliente) {
           $servicios = Servicio::where('clientes_id', $cliente->id)->first();
           if ($servicios) {
               $cliente->codigo = $servicios->codigo;
               $cliente->organizacion = $servicios->organizacion->nombre;
               $cliente->plan = $servicios->plan->nombre;
           }else{
               $cliente->codigo = null;
               $cliente->organizacion = null;
               $cliente->plan = null;
           }
        });
        return view('dashboard._export.export_excel_clientes')
            ->with('clientes', $clientes);
    }

    public function properties(): array
    {
        // TODO: Implement properties() method.
        return [
            'creator'        => config('app.name'),
            'lastModifiedBy' => auth()->user()->name,
            'title'          => 'Clientes Registrados',
            'company'        => 'Morros Devops',
        ];
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return "Clientes Registrados";
    }
}
