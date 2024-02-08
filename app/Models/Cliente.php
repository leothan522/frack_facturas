<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "clientes";
    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'latitud',
        'longitud',
        'gps',
        'fecha_instalacion',
        'fecha_pago',
        'direccion',
    ];

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'clientes_id', 'id');
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class, 'clientes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('cedula', 'LIKE', "%$keyword%")
            ->orWhere('nombre', 'LIKE', "%$keyword%")
            ->orWhere('apellido', 'LIKE', "%$keyword%")
            ;
    }

}
