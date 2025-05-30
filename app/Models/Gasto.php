<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gasto extends Model
{
    use SoftDeletes;
    protected $table = 'gastos';
    protected $fillable = [
        'fecha',
        'concepto',
        'descripcion',
        'monto',
        'moneda',
        'rowquid',
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('fecha', 'LIKE', "%$keyword%")
            ->orWhere('concepto', 'LIKE', "%$keyword%")
            ->orWhere('descripcion', 'LIKE', "%$keyword%")
            ->orWhere('monto', 'LIKE', "%$keyword%")
            ->orWhere('moneda', 'LIKE', "%$keyword%")
            ;
    }

}
