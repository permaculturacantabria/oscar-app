<?php

namespace App\Http\Controllers;

use App\Models\Listener;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SessionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        $sessions = Session::where('user_id', $user->id)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return response()->json($sessions);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        try {
            $validated = $request->validate([
                'listener_id' => ['nullable', 'integer', 'exists:listeners,id'],
                'listener_name' => ['nullable', 'string', 'max:255'],
                'scheduled_at' => ['required', 'string'],
                'status' => ['required', 'in:pendiente,realizada'],
                'notes' => ['nullable', 'string'],
                'categories' => ['nullable', 'array'],
            ]);

            // Parse fecha/hora - acepta formato "YYYY-MM-DD HH:mm:00" o "YYYY-MM-DDTHH:mm"
            try {
                $scheduledAt = Carbon::parse($validated['scheduled_at']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Formato de fecha inválido: ' . $validated['scheduled_at']], 422);
            }

            // If listener_id provided, get the listener name
            if (!empty($validated['listener_id'])) {
                $listener = Listener::where('user_id', $user->id)->find($validated['listener_id']);
                if ($listener) {
                    $validated['listener_name'] = $listener->name;
                }
            }
            
            // If listener_name provided without listener_id, create or reuse listener
            if (empty($validated['listener_id']) && !empty($validated['listener_name'])) {
                $listener = Listener::firstOrCreate(
                    ['user_id' => $user->id, 'name' => $validated['listener_name']],
                    ['user_id' => $user->id, 'name' => $validated['listener_name']]
                );
                $validated['listener_id'] = $listener->id;
            }

            $session = Session::create([
                'user_id' => $user->id,
                'listener_id' => $validated['listener_id'] ?? null,
                'listener_name' => $validated['listener_name'] ?? null,
                'scheduled_at' => $scheduledAt,
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
                'categories' => $validated['categories'] ?? null,
            ]);

            return response()->json($session, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar sesión: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        $session = Session::where('user_id', $user->id)->findOrFail($id);
        return response()->json($session);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        $session = Session::where('user_id', $user->id)->findOrFail($id);

        try {
            $validated = $request->validate([
                'listener_id' => ['nullable', 'integer', 'exists:listeners,id'],
                'listener_name' => ['nullable', 'string', 'max:255'],
                'scheduled_at' => ['nullable', 'string'],
                'status' => ['nullable', 'in:pendiente,realizada'],
                'notes' => ['nullable', 'string'],
                'categories' => ['nullable', 'array'],
            ]);

            // Parse fecha/hora solo si se proporciona
            $scheduledAt = null;
            if (!empty($validated['scheduled_at'])) {
                try {
                    $scheduledAt = Carbon::parse($validated['scheduled_at']);
                } catch (\Exception $e) {
                    return response()->json(['message' => 'Formato de fecha inválido: ' . $validated['scheduled_at']], 422);
                }
            }

            // If listener_id provided, get the listener name
            if (!empty($validated['listener_id'])) {
                $listener = Listener::where('user_id', $user->id)->find($validated['listener_id']);
                if ($listener) {
                    $validated['listener_name'] = $listener->name;
                }
            }
            
            // If listener_name provided without listener_id, create or reuse listener
            if (empty($validated['listener_id']) && !empty($validated['listener_name'])) {
                $listener = Listener::firstOrCreate(
                    ['user_id' => $user->id, 'name' => $validated['listener_name']],
                    ['user_id' => $user->id, 'name' => $validated['listener_name']]
                );
                $validated['listener_id'] = $listener->id;
            }

            $updateData = [];
            
            if (isset($validated['listener_id']) || isset($validated['listener_name'])) {
                if (isset($validated['listener_id'])) {
                    $updateData['listener_id'] = $validated['listener_id'];
                }
                if (isset($validated['listener_name'])) {
                    $updateData['listener_name'] = $validated['listener_name'];
                }
            }
            
            if ($scheduledAt !== null) {
                $updateData['scheduled_at'] = $scheduledAt;
            }
            
            if (isset($validated['status'])) {
                $updateData['status'] = $validated['status'];
            }
            
            if (isset($validated['notes'])) {
                $updateData['notes'] = $validated['notes'];
            }
            
            if (isset($validated['categories'])) {
                $updateData['categories'] = $validated['categories'];
            }
            
            $session->update($updateData);

            return response()->json($session);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar sesión: ' . $e->getMessage()], 500);
        }
    }
}


