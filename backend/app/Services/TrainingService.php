<?php

namespace App\Services;

use App\Models\Training;
use App\Repositories\TrainingRepository;
use Illuminate\Database\Eloquent\Collection;

class TrainingService
{
    protected TrainingRepository $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function getAllTrainings(): Collection
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

    public function updateTraining($id, array $data): Training
    {
        $training = $this->trainingRepository->find($id);
        return $this->trainingRepository->update($training, $data);
    }

    public function deleteTraining($id): ?bool
    {
        $training = $this->trainingRepository->find($id);
        return $this->trainingRepository->delete($training);
    }
}
