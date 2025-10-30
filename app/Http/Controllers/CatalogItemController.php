<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogItemController extends Controller
{
    protected array $allowedTypes = [
        'themes',
        'early-memories',
        'distressing-messages',
        'directions',
        'contradictions',
        'listener-contradictions',
        'reality-bits',
        'restimulations',
        'social-commitments',
        'next-steps',
        'physical-session',
        'frozen-needs',
    ];

    public function index(Request $request)
    {
        $type = $request->query('type');
        if (!in_array($type, $this->allowedTypes, true)) {
            return response()->json(['message' => 'Tipo inválido'], 422);
        }

        $items = CatalogItem::where('user_id', Auth::id())
            ->where('type', $type)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'description', 'notes', 'created_at']);

        return response()->json($items);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        if (!in_array($validated['type'], $this->allowedTypes, true)) {
            return response()->json(['message' => 'Tipo inválido'], 422);
        }

        $item = CatalogItem::create([
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json($item, 201);
    }
}


