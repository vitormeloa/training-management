<?php

namespace App\Services;

use App\Repositories\TrainingRepository;

class TrainingService
{
    protected $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function getAllTrainings()
    {
        return $this->trainingRepository->getAll();
    }

    public function getTrainingById($id)
    {
        return $this->trainingRepository->find($id);
    }

    public function createTraining(array $data)
    {
        return $this->trainingRepository->create($data);
    }

    public function updateTraining($id, array $data)
    {
        $training = $this->trainingRepository->find($id);
        return $this->trainingRepository->update($training, $data);
    }

    public function deleteTraining($id)
    {
        $training = $this->trainingRepository->find($id);
        return $this->trainingRepository->delete($training);
    }
}
