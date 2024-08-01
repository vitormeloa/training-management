<?php

namespace App\Repositories;

use App\Models\Training;
use Illuminate\Database\Eloquent\Collection;

class TrainingRepository
{
    public function getAll(): Collection
    {
        return Training::all();
    }

    public function find($id)
    {
        return Training::findOrFail($id);
    }

    public function create(array $data)
    {
        return Training::create($data);
    }

    public function update(Training $training, array $data): Training
    {
        $training->update($data);
        return $training;
    }

    public function delete(Training $training): ?bool
    {
        return $training->delete();
    }
}

