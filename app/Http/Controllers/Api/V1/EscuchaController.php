<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreEscuchaRequest;
use App\Http\Requests\Api\V1\UpdateEscuchaRequest;
use App\Models\Escucha;
use App\Models\User;
use App\Services\PhoneNormalizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EscuchaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $escuchas = $request->user()->escuchas()->paginate();

        return response()->json($escuchas);
    }

    public function store(StoreEscuchaRequest $request): JsonResponse
    {
        $data = $request->validated();

        $telefonoNormalizado = PhoneNormalizer::normalize($data['telefono']);

        // Buscar usuario real por teléfono
        $usuarioReal = User::where('telefono', $telefonoNormalizado)->first();

        $escucha = Escucha::create([
            'usuario_propietario_id' => $request->user()->id,
            'nombre_asignado' => $data['nombre_asignado'],
            'telefono' => $telefonoNormalizado,
            'id_usuario_real' => $usuarioReal?->id,
        ]);

        return response()->json($escucha, 201);
    }

    public function show(Escucha $escucha): JsonResponse
    {
        $this->authorize('view', $escucha);

        return response()->json($escucha);
    }

    public function update(UpdateEscuchaRequest $request, Escucha $escucha): JsonResponse
    {
        $this->authorize('update', $escucha);

        $data = $request->validated();

        if (isset($data['telefono'])) {
            $data['telefono'] = PhoneNormalizer::normalize($data['telefono']);

            // Actualizar usuario real si cambió el teléfono
            $usuarioReal = User::where('telefono', $data['telefono'])->first();
            $data['id_usuario_real'] = $usuarioReal?->id;
        }

        $escucha->update($data);

        return response()->json($escucha);
    }

    public function destroy(Escucha $escucha): JsonResponse
    {
        $this->authorize('delete', $escucha);

        $escucha->delete();

        return response()->json(['message' => 'Escucha eliminada']);
    }
}