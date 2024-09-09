<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "planes";
    protected $fillable = [
        'nombre',
        'etiqueta_factura',
        'bajada',
        'subida',
        'precio',
        'organizaciones_id',
        'rowquid'
    ];

    public function organizacion(): BelongsTo
    {
        return $this->belongsTo(Organizacion::class, 'organizaciones_id', 'id');
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'planes_id', 'id');
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class, 'planes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            /*->orWhere('nombre', 'LIKE', "%$keyword%")*/
            ;
    }

}
