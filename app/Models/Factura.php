<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "facturas";
    protected $fillable = [
        'factura_numero',
        'factura_fecha',
        'factura_subtotal',
        'factura_iva',
        'factura_total',
        'servicios_codigo',
        'organizacion_nombre',
        'organizacion_email',
        'organizacion_telefono',
        'organizacion_web',
        'organizacion_moneda',
        'cliente_cedula',
        'cliente_nombre',
        'cliente_apellido',
        'cliente_email',
        'cliente_telefono',
        'cliente_latitud',
        'cliente_longitud',
        'cliente_gps',
        'cliente_fecha_instalacion',
        'cliente_fecha_pago',
        'cliente_direccion',
        'plan_nombre',
        'plan_etiqueta',
        'plan_bajada',
        'plan_subida',
        'plan_precio',
        'servicios_id',
        'clientes_id',
        'organizaciones_id',
        'planes_id',
        'pagos_id',
        'send',
        'rowquid'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('factura_numero', 'LIKE', "%$keyword%")
            /*->orWhere('nombre', 'LIKE', "%$keyword%")*/
            ;
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'servicios_id', 'id');
    }

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

    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class, 'facturas_id', 'id');
    }


}
