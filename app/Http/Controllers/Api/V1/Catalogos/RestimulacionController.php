<?php

namespace App\Http\Controllers\Api\V1\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Restimulacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestimulacionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $restimulaciones = $request->user()->restimulaciones()->paginate();

        return response()->json($restimulaciones);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $restimulacion = Restimulacion::create([
            'user_id' => $request->user()->id,
            'texto' => $request->texto,
        ]);

        return response()->json($restimulacion, 201);
    }

    public function show(Restimulacion $restimulacion): JsonResponse
    {
        $this->authorize('view', $restimulacion);

        return response()->json($restimulacion);
    }

    public function update(Request $request, Restimulacion $restimulacion): JsonResponse
    {
        $this->authorize('update', $restimulacion);

        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $restimulacion->update($request->only('texto'));

        return response()->json($restimulacion);
    }

    public function destroy(Restimulacion $restimulacion): JsonResponse
    {
        $this->authorize('delete', $restimulacion);

        $restimulacion->delete();

        return response()->json(['message' => 'Restimulacion eliminada']);
    }

    public function quickStore(Request $request): JsonResponse
    {
        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $restimulacion = Restimulacion::firstOrCreate([
            'user_id' => $request->user()->id,
            'texto' => $request->texto,
        ]);

        return response()->json($restimulacion, 201);
    }
}