<?php

namespace App\Exports;

use App\Models\Gasto;
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

class GastosExport implements FromView, WithTitle, WithProperties, WithColumnFormatting, ShouldAutoSize
{
    public $gastos;
    public function __construct($gastos)
    {
        $this->gastos = $gastos;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        foreach ($this->gastos as $gasto) {
            $fecha = Carbon::create($gasto->fecha);
            $gasto->fecha = Date::dateTimeToExcel($fecha);
        }
        return view('dashboard._export.export_excel_gastos')
            ->with('gastos', $this->gastos);
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function properties(): array
    {
        // TODO: Implement properties() method.
        return [
            'creator'        => config('app.name'),
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Gastos Registrados',
            'company'        => "Morros Devops",
        ];
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Gastos';
    }
}
