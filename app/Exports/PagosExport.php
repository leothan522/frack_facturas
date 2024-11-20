<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PagosExport implements FromView, WithTitle, WithProperties, WithColumnFormatting, ShouldAutoSize

{
    public $pagos;
    public function __construct($pagos)
    {
        $this->pagos = $pagos;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        foreach ($this->pagos as $pago) {
            $fecha = Carbon::create($pago->fecha);
            $pago->fecha = Date::dateTimeToExcel($fecha);
            $pago->referencia = "#".$pago->referencia;
        }
        return view('dashboard._export.export_excel_pagos')
            ->with('pagos', $this->pagos);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Pagos';
    }

    public function properties(): array
    {
        // TODO: Implement properties() method.
        return [
            'creator'        => config('app.name'),
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Pagos Registrados',
            'company'        => "Morros Devops",
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_TEXT
        ];
    }
}
