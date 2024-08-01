<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\UserTrainingService;

class UserTrainingController extends Controller
{
    protected UserTrainingService $userTrainingService;

    public function __construct(UserTrainingService $userTrainingService)
    {
        $this->userTrainingService = $userTrainingService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userTrainingService->getAllUserTrainings());
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'training_id' => 'required|exists:trainings,id',
            'status' => 'required|in:pending,completed',
        ]);

        $userTraining = $this->userTrainingService->createUserTraining($validatedData);
        return response()->json($userTraining, 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->userTrainingService->getUserTrainingById($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'training_id' => 'sometimes|exists:trainings,id',
            'status' => 'sometimes|in:pending,completed',
        ]);

        $userTraining = $this->userTrainingService->updateUserTraining($id, $validatedData);
        return response()->json($userTraining, 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->userTrainingService->deleteUserTraining($id);
        return response()->json(null, 204);
    }
}
