<?php

namespace App\Services;

use App\Repositories\UserTrainingRepository;

class UserTrainingService
{
    protected $userTrainingRepository;

    public function __construct(UserTrainingRepository $userTrainingRepository)
    {
        $this->userTrainingRepository = $userTrainingRepository;
    }

    public function getAllUserTrainings()
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

    public function updateUserTraining($id, array $data)
    {
        $userTraining = $this->userTrainingRepository->find($id);
        return $this->userTrainingRepository->update($userTraining, $data);
    }

    public function deleteUserTraining($id)
    {
        $userTraining = $this->userTrainingRepository->find($id);
        return $this->userTrainingRepository->delete($userTraining);
    }
}
