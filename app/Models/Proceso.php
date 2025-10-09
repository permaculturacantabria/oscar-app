<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proceso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'escucha_id',
        'nombre_proceso',
        'fecha_creacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function escucha(): BelongsTo
    {
        return $this->belongsTo(Escucha::class);
    }

    public function sesiones(): HasMany
    {
        return $this->hasMany(Sesion::class);
    }
}