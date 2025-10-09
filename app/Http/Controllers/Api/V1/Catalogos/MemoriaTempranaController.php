<?php

namespace App\Http\Controllers\Api\V1\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\MemoriaTemprana;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemoriaTempranaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $memorias = $request->user()->memoriasTempranas()->paginate();

        return response()->json($memorias);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $memoria = MemoriaTemprana::create([
            'user_id' => $request->user()->id,
            'texto' => $request->texto,
        ]);

        return response()->json($memoria, 201);
    }

    public function show(MemoriaTemprana $memoriaTemprana): JsonResponse
    {
        $this->authorize('view', $memoriaTemprana);

        return response()->json($memoriaTemprana);
    }

    public function update(Request $request, MemoriaTemprana $memoriaTemprana): JsonResponse
    {
        $this->authorize('update', $memoriaTemprana);

        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $memoriaTemprana->update($request->only('texto'));

        return response()->json($memoriaTemprana);
    }

    public function destroy(MemoriaTemprana $memoriaTemprana): JsonResponse
    {
        $this->authorize('delete', $memoriaTemprana);

        $memoriaTemprana->delete();

        return response()->json(['message' => 'Memoria temprana eliminada']);
    }

    public function quickStore(Request $request): JsonResponse
    {
        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $memoria = MemoriaTemprana::firstOrCreate([
            'user_id' => $request->user()->id,
            'texto' => $request->texto,
        ]);

        return response()->json($memoria, 201);
    }
}