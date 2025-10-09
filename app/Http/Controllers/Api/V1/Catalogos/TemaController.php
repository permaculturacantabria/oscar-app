<?php

namespace App\Http\Controllers\Api\V1\Catalogos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Catalogos\StoreTemaRequest;
use App\Http\Requests\Api\V1\Catalogos\UpdateTemaRequest;
use App\Models\Tema;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $temas = $request->user()->temas()->paginate();

        return response()->json($temas);
    }

    public function store(StoreTemaRequest $request): JsonResponse
    {
        $tema = Tema::create([
            'user_id' => $request->user()->id,
            'texto' => $request->texto,
        ]);

        return response()->json($tema, 201);
    }

    public function show(Tema $tema): JsonResponse
    {
        $this->authorize('view', $tema);

        return response()->json($tema);
    }

    public function update(UpdateTemaRequest $request, Tema $tema): JsonResponse
    {
        $this->authorize('update', $tema);

        $tema->update($request->validated());

        return response()->json($tema);
    }

    public function destroy(Tema $tema): JsonResponse
    {
        $this->authorize('delete', $tema);

        $tema->delete();

        return response()->json(['message' => 'Tema eliminado']);
    }

    public function quickStore(Request $request): JsonResponse
    {
        $request->validate([
            'texto' => 'required|string|max:1000',
        ]);

        $tema = Tema::firstOrCreate([
            'user_id' => $request->user()->id,
            'texto' => $request->texto,
        ]);

        return response()->json($tema, 201);
    }
}