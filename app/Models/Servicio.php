<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "servicios";
    protected $fillable = [
        'codigo',
        'clientes_id',
        'organizaciones_id',
        'planes_id'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }

    public function organizacion(): BelongsTo
    {
        return $this->belongsTo(Organizacion::class, 'organizaciones_id', 'id');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'planes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('codigo', 'LIKE', "%$keyword%")
            /*->orWhere('nombre', 'LIKE', "%$keyword%")*/
            ;
    }


}
