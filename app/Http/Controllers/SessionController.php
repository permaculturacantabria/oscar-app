<?php

namespace App\Http\Controllers;

use App\Models\Listener;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'listener_id' => ['nullable', 'integer', 'exists:listeners,id'],
            'listener_name' => ['nullable', 'string', 'max:255'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'in:pendiente,realizada'],
            'notes' => ['nullable', 'string'],
            'categories' => ['nullable', 'array'],
        ]);

        // If listener_name provided without listener_id, create or reuse listener
        if (empty($validated['listener_id']) && !empty($validated['listener_name'])) {
            $listener = Listener::firstOrCreate(
                ['user_id' => $user->id, 'name' => $validated['listener_name']]
            );
            $validated['listener_id'] = $listener->id;
        }

        $session = Session::create([
            'user_id' => $user->id,
            'listener_id' => $validated['listener_id'] ?? null,
            'listener_name' => $validated['listener_name'] ?? null,
            'scheduled_at' => Carbon::parse($validated['scheduled_at']),
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
            'categories' => $validated['categories'] ?? null,
        ]);

        return response()->json($session, 201);
    }
}


