<?php

namespace App\Services;

use App\Models\CompromisoSocial;
use App\Models\Contradiccion;
use App\Models\ContradiccionEscucha;
use App\Models\Direccion;
use App\Models\MemoriaTemprana;
use App\Models\MensajeAngustioso;
use App\Models\NecesidadCongelada;
use App\Models\PedacitoRealidad;
use App\Models\ProximoPaso;
use App\Models\Restimulacion;
use App\Models\SesionFisica;
use App\Models\Tema;

class UpsertCatalogoEnSesion
{
    private static array $catalogFields = [
        'tema' => Tema::class,
        'memoria_temprana' => MemoriaTemprana::class,
        'mensaje_angustioso' => MensajeAngustioso::class,
        'direccion' => Direccion::class,
        'contradiccion' => Contradiccion::class,
        'contradiccion_escucha' => ContradiccionEscucha::class,
        'pedacito_realidad' => PedacitoRealidad::class,
        'restimulacion' => Restimulacion::class,
        'compromiso_social' => CompromisoSocial::class,
        'proximo_paso' => ProximoPaso::class,
        'sesion_fisica' => SesionFisica::class,
        'necesidad_congelada' => NecesidadCongelada::class,
    ];

    public static function upsert(array $data, int $userId): array
    {
        $fkData = [];

        foreach (self::$catalogFields as $field => $model) {
            if (isset($data[$field])) {
                $catalog = $model::firstOrCreate(
                    ['user_id' => $userId, 'texto' => $data[$field]],
                    ['user_id' => $userId, 'texto' => $data[$field]]
                );
                $fkData["{$field}_id"] = $catalog->id;
            }
        }

        return $fkData;
    }
}