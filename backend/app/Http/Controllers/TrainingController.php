<?php

namespace App\Http\Controllers;

use App\Services\TrainingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    protected TrainingService $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->trainingService->getAllTrainings());
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $training = $this->trainingService->createTraining($validatedData);
        return response()->json($training, 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->trainingService->getTrainingById($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $training = $this->trainingService->updateTraining($id, $validatedData);
        return response()->json($training, 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->trainingService->deleteTraining($id);
        return response()->json(null, 204);
    }
}
