<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Antena extends Model
{
    protected $table = "antenas_sectoriales";
    protected $fillable = ['nombre', 'direccion_ip', 'rowquid'];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'antenas_id', 'id');
    }
}
