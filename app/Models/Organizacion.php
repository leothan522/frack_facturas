<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "organizaciones";
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'web',
        'moneda',
        'dias_factura',
        'formato_factura',
        'proxima_factura',
        'direccion',
        'rowquid'
    ];

    public function planes(): HasMany
    {
        return $this->hasMany(Plan::class, 'organizaciones_id', 'id');
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'organizaciones_id', 'id');
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class, 'organizaciones_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ;
    }

}
