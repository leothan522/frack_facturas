<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
