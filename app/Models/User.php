<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'telefono',
        'email',
        'nombre',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_alta' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName(): string
    {
        return 'telefono';
    }

    public function escuchas(): HasMany
    {
        return $this->hasMany(Escucha::class, 'usuario_propietario_id');
    }

    public function sesiones(): HasMany
    {
        return $this->hasMany(Sesion::class);
    }

    public function procesos(): HasMany
    {
        return $this->hasMany(Proceso::class);
    }

    public function temas(): HasMany
    {
        return $this->hasMany(Tema::class);
    }

    public function memoriasTempranas(): HasMany
    {
        return $this->hasMany(MemoriaTemprana::class);
    }

    public function mensajesAngustiosos(): HasMany
    {
        return $this->hasMany(MensajeAngustioso::class);
    }

    public function direcciones(): HasMany
    {
        return $this->hasMany(Direccion::class);
    }

    public function contradicciones(): HasMany
    {
        return $this->hasMany(Contradiccion::class);
    }

    public function pedacitosRealidad(): HasMany
    {
        return $this->hasMany(PedacitoRealidad::class);
    }

    public function restimulaciones(): HasMany
    {
        return $this->hasMany(Restimulacion::class);
    }

    public function compromisosSociales(): HasMany
    {
        return $this->hasMany(CompromisoSocial::class);
    }

    public function contradiccionesEscuchas(): HasMany
    {
        return $this->hasMany(ContradiccionEscucha::class);
    }

    public function proximosPasos(): HasMany
    {
        return $this->hasMany(ProximoPaso::class);
    }

    public function sesionesFisicas(): HasMany
    {
        return $this->hasMany(SesionFisica::class);
    }

    public function necesidadesCongeladas(): HasMany
    {
        return $this->hasMany(NecesidadCongelada::class);
    }
}
