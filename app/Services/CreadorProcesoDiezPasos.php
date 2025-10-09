<?php

namespace App\Services;

use App\Enums\Estado;
use App\Enums\TipoSesion;
use App\Models\Proceso;
use App\Models\Sesion;
use Illuminate\Support\Facades\DB;

class CreadorProcesoDiezPasos
{
    public static function crear(int $usuarioId, int $escuchaId, string $nombreProceso): Proceso
    {
        return DB::transaction(function () use ($usuarioId, $escuchaId, $nombreProceso) {
            $proceso = Proceso::create([
                'usuario_id' => $usuarioId,
                'escucha_id' => $escuchaId,
                'nombre_proceso' => $nombreProceso,
                'fecha_creacion' => now(),
            ]);

            $etiquetas = [
                'Tema',
                'Memorias tempranas',
                'Mensajes angustiosos',
                'Direcciones',
                'Contradicciones',
                'Contradicciones del escucha',
                'Pedacitos de realidad',
                'Restimulaciones',
                'Compromisos sociales',
                'Evaluación / Próximos pasos',
            ];

            if (count($etiquetas) !== 10) {
                throw new \Exception('Debe haber exactamente 10 etiquetas');
            }

            foreach ($etiquetas as $index => $etiqueta) {
                Sesion::create([
                    'usuario_id' => $usuarioId,
                    'escucha_id' => $escuchaId,
                    'proceso_id' => $proceso->id,
                    'nombre_sesion' => "{$etiqueta} – {$nombreProceso}",
                    'tipo_sesion' => TipoSesion::PROCESO_10_PASOS,
                    'estado' => Estado::PENDIENTE,
                    'fecha' => now()->addDays($index)->toDateString(),
                    'hora' => '10:00',
                    'duracion' => 60,
                ]);
            }

            return $proceso;
        });
    }
}