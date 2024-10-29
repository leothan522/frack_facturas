<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Metodo extends Model
{
    protected $table = "pagos_metodos";
    protected $fillable = [
        'metodo',
        'titular',
        'cuenta',
        'tipo',
        'cedula',
        'telefono',
        'email',
        'bancos_id'
    ];

    public function banco(): BelongsTo{
        return $this->belongsTo(Banco::class, 'bancos_id', 'id');
    }
}
