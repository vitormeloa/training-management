<?php

namespace App\Http\Controllers;

use App\Models\SubordinateTraining;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubordinateTrainingController extends Controller
{
    public function index(): Collection
    {
        return SubordinateTraining::with('subordinate')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'subordinate_id' => 'required|exists:subordinates,id',
            'training_id' => 'required|exists:trainings,id',
            'completed' => 'boolean',
        ]);

        return SubordinateTraining::create($request->all());
    }

    public function show(SubordinateTraining $subordinateTraining): SubordinateTraining
    {
        return $subordinateTraining;
    }

    public function update(Request $request, SubordinateTraining $subordinateTraining): SubordinateTraining
    {
        $request->validate([
            'completed' => 'boolean',
        ]);

        $subordinateTraining->update($request->all());

        return $subordinateTraining;
    }

    public function destroy(SubordinateTraining $subordinateTraining): Response
    {
        $subordinateTraining->delete();

        return response()->noContent();
    }
}
