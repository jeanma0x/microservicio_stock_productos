<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venta extends Model
{
    protected $fillable = ['nit', 'fecha', 'total', 'user_id'];

    //tabla ventas sí tiene created at y updated at
    public $timestamps = true;

    protected $casts = [
        'fecha' => 'datetime',
        'total' => 'decimal:2',
        'nit' => 'string',
    ];

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
