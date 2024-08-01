<?php

namespace App\Http\Controllers;

use App\Services\TrainingService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    protected $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function index()
    {
        return response()->json($this->trainingService->getAllTrainings());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $training = $this->trainingService->createTraining($validatedData);
        return response()->json($training, 201);
    }

    public function show($id)
    {
        return response()->json($this->trainingService->getTrainingById($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $training = $this->trainingService->updateTraining($id, $validatedData);
        return response()->json($training, 200);
    }

    public function destroy($id)
    {
        $this->trainingService->deleteTraining($id);
        return response()->json(null, 204);
    }
}
