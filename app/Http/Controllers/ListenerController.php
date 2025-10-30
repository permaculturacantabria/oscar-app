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
            ->get(['id', 'name']);
        return response()->json($listeners);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $listener = Listener::firstOrCreate([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
        ]);

        return response()->json($listener, 201);
    }
}


