<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainingController extends Controller
{
    public function index(): Collection
    {
        return Training::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Training::create($request->all());
    }

    public function show(Training $training): Training
    {
        return $training;
    }

    public function update(Request $request, Training $training): Training
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $training->update($request->all());

        return $training;
    }

    public function destroy(Training $training): Response
    {
        $training->delete();

        return response()->noContent();
    }
}

