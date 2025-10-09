<?php

namespace App\Models;

use App\Enums\Modalidad;
use App\Enums\Estado;
use App\Enums\TipoSesion;
use App\Enums\DescargaDominante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sesion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'escucha_id',
        'nombre_sesion',
        'modalidad',
        'estado',
        'tipo_sesion',
        'fecha',
        'hora',
        'duracion',
        'notas',
        'tema_id',
        'memoria_temprana_id',
        'mensaje_angustioso_id',
        'direccion_id',
        'contradiccion_id',
        'contradiccion_escucha_id',
        'pedacito_realidad_id',
        'restimulacion_id',
        'compromiso_social_id',
        'proximo_paso_id',
        'sesion_fisica_id',
        'necesidad_congelada_id',
        'evaluacion_1',
        'evaluacion_2',
        'descarga_dominante',
        'proceso_id',
    ];

    protected $casts = [
        'modalidad' => Modalidad::class,
        'estado' => Estado::class,
        'tipo_sesion' => TipoSesion::class,
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'duracion' => 'integer',
        'evaluacion_1' => 'integer',
        'evaluacion_2' => 'integer',
        'descarga_dominante' => DescargaDominante::class,
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function escucha(): BelongsTo
    {
        return $this->belongsTo(Escucha::class);
    }

    public function proceso(): BelongsTo
    {
        return $this->belongsTo(Proceso::class);
    }

    public function tema(): BelongsTo
    {
        return $this->belongsTo(Tema::class);
    }

    public function memoriaTemprana(): BelongsTo
    {
        return $this->belongsTo(MemoriaTemprana::class, 'memoria_temprana_id');
    }

    public function mensajeAngustioso(): BelongsTo
    {
        return $this->belongsTo(MensajeAngustioso::class, 'mensaje_angustioso_id');
    }

    public function direccion(): BelongsTo
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    public function contradiccion(): BelongsTo
    {
        return $this->belongsTo(Contradiccion::class, 'contradiccion_id');
    }

    public function contradiccionEscucha(): BelongsTo
    {
        return $this->belongsTo(ContradiccionEscucha::class, 'contradiccion_escucha_id');
    }

    public function pedacitoRealidad(): BelongsTo
    {
        return $this->belongsTo(PedacitoRealidad::class, 'pedacito_realidad_id');
    }

    public function restimulacion(): BelongsTo
    {
        return $this->belongsTo(Restimulacion::class, 'restimulacion_id');
    }

    public function compromisoSocial(): BelongsTo
    {
        return $this->belongsTo(CompromisoSocial::class, 'compromiso_social_id');
    }

    public function proximoPaso(): BelongsTo
    {
        return $this->belongsTo(ProximoPaso::class, 'proximo_paso_id');
    }

    public function sesionFisica(): BelongsTo
    {
        return $this->belongsTo(SesionFisica::class, 'sesion_fisica_id');
    }

    public function necesidadCongelada(): BelongsTo
    {
        return $this->belongsTo(NecesidadCongelada::class, 'necesidad_congelada_id');
    }
}