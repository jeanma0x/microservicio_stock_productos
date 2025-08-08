<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    protected $fillable = ['fecha', 'total', 'nit'];

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
