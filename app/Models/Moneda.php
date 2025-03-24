<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    //
    protected $table = 'pagos_monedas';
    protected $fillable = ['nombre', 'codigo'];

}
