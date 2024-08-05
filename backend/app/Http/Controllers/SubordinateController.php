<?php

namespace App\Http\Controllers;

use App\Models\Subordinate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SubordinateController extends Controller
{
    public function index(): JsonResponse
    {
        $subordinates = Auth::user()->subordinates;
        return response()->json($subordinates);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:subordinates',
        ]);

        $subordinate = Auth::user()->subordinates()->create($request->all());
        return response()->json($subordinate, 201);
    }

    public function show(Subordinate $subordinate): JsonResponse
    {
        if ($subordinate->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json($subordinate);
    }

    public function update(Request $request, Subordinate $subordinate): JsonResponse
    {
        if ($subordinate->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:subordinates,email,' . $subordinate->id,
        ]);

        $subordinate->update($request->all());
        return response()->json($subordinate);
    }

    public function destroy(Subordinate $subordinate): Response|JsonResponse
    {
        if ($subordinate->user_id !== Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $subordinate->delete();
        return response()->noContent();
    }
}

