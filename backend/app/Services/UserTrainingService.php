<?php

namespace App\Services;

use App\Models\UserTraining;
use App\Repositories\UserTrainingRepository;
use Illuminate\Database\Eloquent\Collection;

class UserTrainingService
{
    protected UserTrainingRepository $userTrainingRepository;

    public function __construct(UserTrainingRepository $userTrainingRepository)
    {
        $this->userTrainingRepository = $userTrainingRepository;
    }

    public function getAllUserTrainings(): Collection
    {
        return $this->userTrainingRepository->getAll();
    }

    public function getUserTrainingById($id)
    {
        return $this->userTrainingRepository->find($id);
    }

    public function createUserTraining(array $data)
    {
        return $this->userTrainingRepository->create($data);
    }

    public function updateUserTraining($id, array $data): UserTraining
    {
        $userTraining = $this->userTrainingRepository->find($id);
        return $this->userTrainingRepository->update($userTraining, $data);
    }

    public function deleteUserTraining($id): ?bool
    {
        $userTraining = $this->userTrainingRepository->find($id);
        return $this->userTrainingRepository->delete($userTraining);
    }
}
