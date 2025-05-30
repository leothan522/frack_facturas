<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $fillable = [
        'tabla_id',
        'imagen',
        'mini',
        'detail',
        'cart',
        'banner',
        'rowquid'
    ];
}
