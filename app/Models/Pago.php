<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $table = "pagos";
    protected $fillable = [
        'referencia',
        'fecha',
        'monto',
        'moneda',
        'metodo',
        'titular',
        'cuenta',
        'tipo',
        'cedula',
        'telefono',
        'email',
        'nombre',
        'codigo',
        'dollar',
        'factura_numero',
        'clientes_id',
        'facturas_id',
        'estatus',
        'rowquid'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('referencia', 'LIKE', "%$keyword%")
            ->orWhere('fecha', 'LIKE', "%$keyword%")
            ->orWhere('factura_numero', 'LIKE', "%$keyword%")
            ;
    }

    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class, 'facturas_id', 'id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }

}
