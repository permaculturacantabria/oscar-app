<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Sesion;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $user = auth()->user();

        // Minutos totales de sesiones
        $totalMinutos = $user->sesiones()->sum('duracion');

        // Total de sesiones
        $totalSesiones = $user->sesiones()->count();

        // Avance de procesos (sesiones completadas / total)
        $procesos = $user->procesos()->with('sesiones')->get();
        $procesosAvance = $procesos->map(function ($proceso) {
            $totalSesiones = $proceso->sesiones->count();
            $sesionesCompletadas = $proceso->sesiones->where('estado', 'realizada')->count();

            return [
                'id' => $proceso->id,
                'nombre' => $proceso->nombre_proceso,
                'avance' => $totalSesiones > 0 ? round(($sesionesCompletadas / $totalSesiones) * 100, 2) : 0,
                'sesiones_completadas' => $sesionesCompletadas,
                'total_sesiones' => $totalSesiones,
            ];
        });

        // Últimos registros de catálogos
        $ultimosCatalogos = [
            'temas' => $user->temas()->latest()->take(5)->get(),
            'memorias_tempranas' => $user->memoriasTempranas()->latest()->take(5)->get(),
            'mensajes_angustiosos' => $user->mensajesAngustiosos()->latest()->take(5)->get(),
            'direcciones' => $user->direcciones()->latest()->take(5)->get(),
            'contradicciones' => $user->contradicciones()->latest()->take(5)->get(),
            'pedacitos_realidad' => $user->pedacitosRealidad()->latest()->take(5)->get(),
            'restimulaciones' => $user->restimulaciones()->latest()->take(5)->get(),
            'compromisos_sociales' => $user->compromisosSociales()->latest()->take(5)->get(),
            'proximos_pasos' => $user->proximosPasos()->latest()->take(5)->get(),
        ];

        // Sugerencias de próximos pasos
        $sugerencias = $this->generarSugerencias($user);

        return response()->json([
            'resumen' => [
                'total_minutos' => $totalMinutos,
                'total_sesiones' => $totalSesiones,
                'procesos_avance' => $procesosAvance,
                'ultimos_catalogos' => $ultimosCatalogos,
                'proximos_pasos_sugeridos' => $sugerencias,
            ],
        ]);
    }

    private function generarSugerencias($user): array
    {
        $sugerencias = [];

        // Si hay muchas restimulaciones, sugerir crear sesión
        $restimulacionesCount = $user->restimulaciones()->count();
        if ($restimulacionesCount >= 5) {
            $sugerencias[] = [
                'tipo' => 'restimulaciones_acumuladas',
                'mensaje' => "Tienes {$restimulacionesCount} restimulaciones registradas. Considera crear una nueva sesión para procesarlas.",
                'accion' => 'crear_sesion',
            ];
        }

        // Si hay procesos incompletos
        $procesosIncompletos = $user->procesos()
            ->whereHas('sesiones', function ($query) {
                $query->where('estado', '!=', 'realizada');
            })
            ->count();

        if ($procesosIncompletos > 0) {
            $sugerencias[] = [
                'tipo' => 'procesos_pendientes',
                'mensaje' => "Tienes {$procesosIncompletos} procesos con sesiones pendientes.",
                'accion' => 'completar_sesiones',
            ];
        }

        // Si no hay sesiones recientes
        $sesionesRecientes = $user->sesiones()
            ->where('fecha', '>=', now()->subDays(7))
            ->count();

        if ($sesionesRecientes === 0) {
            $sugerencias[] = [
                'tipo' => 'sin_sesiones_recientes',
                'mensaje' => 'No has tenido sesiones en la última semana. Considera programar una.',
                'accion' => 'programar_sesion',
            ];
        }

        return $sugerencias;
    }
}