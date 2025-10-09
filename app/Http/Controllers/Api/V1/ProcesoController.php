<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreProcesoRequest;
use App\Http\Requests\Api\V1\UpdateProcesoRequest;
use App\Models\Proceso;
use App\Services\CreadorProcesoDiezPasos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $procesos = $request->user()->procesos()->with('escucha')->paginate();

        return response()->json($procesos);
    }

    public function store(StoreProcesoRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Validate that the escucha belongs to the user
        $escucha = $request->user()->escuchas()->find($data['escucha_id']);
        if (!$escucha) {
            return response()->json(['error' => 'Escucha not found or does not belong to user'], 404);
        }

        $proceso = CreadorProcesoDiezPasos::crear(
            $request->user()->id,
            $data['escucha_id'],
            $data['nombre_proceso']
        );

        return response()->json($proceso->load('escucha'), 201);
    }

    public function show(Proceso $proceso): JsonResponse
    {
        $this->authorize('view', $proceso);

        return response()->json($proceso->load('escucha'));
    }

    public function update(UpdateProcesoRequest $request, Proceso $proceso): JsonResponse
    {
        $this->authorize('update', $proceso);

        $proceso->update($request->validated());

        return response()->json($proceso->load('escucha'));
    }

    public function destroy(Proceso $proceso): JsonResponse
    {
        $this->authorize('delete', $proceso);

        $proceso->delete();

        return response()->json(['message' => 'Proceso eliminado']);
    }

    public function sesiones(Proceso $proceso): JsonResponse
    {
        $this->authorize('view', $proceso);

        $sesiones = $proceso->sesiones()->with(['escucha'])->orderBy('fecha')->get();

        return response()->json($sesiones);
    }
}