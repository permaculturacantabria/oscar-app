<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Estado;
use App\Enums\TipoSesion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSesionRequest;
use App\Http\Requests\Api\V1\UpdateSesionRequest;
use App\Http\Requests\Api\V1\UpdateSesionStatusRequest;
use App\Models\Sesion;
use App\Services\UpsertCatalogoEnSesion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = $request->user()->sesiones()->with(['escucha', 'proceso']);

        // Filtros
        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('tipo_sesion')) {
            $query->where('tipo_sesion', $request->tipo_sesion);
        }

        if ($request->has('fecha_desde')) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }

        if ($request->has('fecha_hasta')) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }

        if ($request->has('escucha_id')) {
            $query->where('escucha_id', $request->escucha_id);
        }

        $sesiones = $query->paginate();

        return response()->json($sesiones);
    }

    public function store(StoreSesionRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validate that the escucha belongs to the user
        $escucha = $request->user()->escuchas()->find($data['escucha_id']);
        if (!$escucha) {
            return response()->json(['error' => 'Escucha not found or does not belong to user'], 404);
        }

        // Crear catálogos al vuelo si se proporcionan textos
        $catalogosData = [];
        $catalogosFields = [
            'tema',
            'memoria_temprana',
            'mensaje_angustioso',
            'direccion',
            'contradiccion',
            'pedacito_realidad',
            'restimulacion',
            'compromiso_social',
            'proximo_paso',
            'sesion_fisica',
            'necesidad_congelada',
        ];

        foreach ($catalogosFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $catalogosData[$field] = $data[$field];
                unset($data[$field]);
            }
        }

        if (!empty($catalogosData)) {
            $catalogosIds = UpsertCatalogoEnSesion::upsert($catalogosData, $request->user()->id);
            $data = array_merge($data, $catalogosIds);
        }

        $sesion = Sesion::create($data);

        return response()->json($sesion->load(['escucha', 'proceso']), 201);
    }

    public function show(Sesion $sesion): JsonResponse
    {
        $this->authorize('view', $sesion);

        return response()->json($sesion->load([
            'escucha',
            'proceso',
            'tema',
            'memoriaTemprana',
            'mensajeAngustioso',
            'direccion',
            'contradiccion',
            'pedacitoRealidad',
            'restimulacion',
            'compromisoSocial',
            'proximoPaso',
            'sesionFisica',
            'necesidadCongelada',
        ]));
    }

    public function update(UpdateSesionRequest $request, Sesion $sesion): JsonResponse
    {
        $this->authorize('update', $sesion);

        $data = $request->validated();

        // Crear catálogos al vuelo si se proporcionan textos
        $catalogosData = [];
        $catalogosFields = [
            'tema',
            'memoria_temprana',
            'mensaje_angustioso',
            'direccion',
            'contradiccion',
            'pedacito_realidad',
            'restimulacion',
            'compromiso_social',
            'proximo_paso',
            'sesion_fisica',
            'necesidad_congelada',
        ];

        foreach ($catalogosFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $catalogosData[$field] = $data[$field];
                unset($data[$field]);
            }
        }

        if (!empty($catalogosData)) {
            $catalogosIds = UpsertCatalogoEnSesion::upsert($catalogosData, $request->user()->id);
            $data = array_merge($data, $catalogosIds);
        }

        $sesion->update($data);

        return response()->json($sesion->load([
            'escucha',
            'proceso',
            'tema',
            'memoriaTemprana',
            'mensajeAngustioso',
            'direccion',
            'contradiccion',
            'pedacitoRealidad',
            'restimulacion',
            'compromisoSocial',
            'proximoPaso',
            'sesionFisica',
            'necesidadCongelada',
        ]));
    }

    public function updateStatus(UpdateSesionStatusRequest $request, Sesion $sesion): JsonResponse
    {
        $this->authorize('update', $sesion);

        $sesion->update(['estado' => $request->estado]);

        return response()->json($sesion);
    }

    public function destroy(Sesion $sesion): JsonResponse
    {
        $this->authorize('delete', $sesion);

        $sesion->delete();

        return response()->json(['message' => 'Sesión eliminada']);
    }

    public function filters(): JsonResponse
    {
        return response()->json([
            'estados' => Estado::cases(),
            'tipos_sesion' => TipoSesion::cases(),
        ]);
    }
}