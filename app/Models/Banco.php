<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banco extends Model
{
    protected $table = 'bancos';
    protected $fillable = ['nombre', 'codigo'];

    public function metodos(): HasMany
    {
        return $this->hasMany(Metodo::class, 'bancos_id', 'id');
    }
}
