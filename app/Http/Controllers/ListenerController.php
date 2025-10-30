<?php

namespace App\Http\Controllers;

use App\Models\Listener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListenerController extends Controller
{
    public function index()
    {
        $listeners = Listener::where('user_id', Auth::id())
            ->orderBy('name')
            ->get(['id', 'name', 'last_name', 'email', 'phone']);
        return response()->json($listeners);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $listener = Listener::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        return response()->json($listener, 201);
    }

    public function show($id)
    {
        $listener = Listener::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($listener);
    }

    public function update(Request $request, $id)
    {
        $listener = Listener::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $listener->update([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        return response()->json($listener);
    }
}


