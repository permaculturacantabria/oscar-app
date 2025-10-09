<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escucha extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario_propietario_id',
        'nombre_asignado',
        'telefono',
        'id_usuario_real',
    ];

    protected $casts = [
        'telefono' => 'string',
    ];

    public function usuarioPropietario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_propietario_id');
    }

    public function usuarioReal(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario_real');
    }

    public function sesiones(): HasMany
    {
        return $this->hasMany(Sesion::class);
    }

    public function procesos(): HasMany
    {
        return $this->hasMany(Proceso::class);
    }
}