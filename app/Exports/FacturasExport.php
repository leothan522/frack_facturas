<?php

namespace App\Exports;

use App\Models\Factura;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FacturasExport implements FromView, WithTitle, WithProperties, WithColumnFormatting, ShouldAutoSize
{
    public $facturas;
    public function __construct($facturas)
    {
        $this->facturas = $facturas;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        foreach ($this->facturas as $pago) {
            $fecha = Carbon::create($pago->fecha);
            $pago->fecha = Date::dateTimeToExcel($fecha);
            $pago->referencia = "#".$pago->referencia;
        }
        return view('dashboard._export.export_excel_facturas')
            ->with('facturas', $this->facturas);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Facturas';
    }

    public function properties(): array
    {
        // TODO: Implement properties() method.
        return [
            'creator'        => config('app.name'),
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Facturas Registradas',
            'company'        => "Morros Devops",
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H' => NumberFormat::FORMAT_TEXT
        ];
    }
}
