<?php

namespace App\Repositories;

use App\Models\UserTraining;
use Illuminate\Database\Eloquent\Collection;

class UserTrainingRepository
{
    public function getAll(): Collection
    {
        return UserTraining::all();
    }

    public function find($id)
    {
        return UserTraining::findOrFail($id);
    }

    public function create(array $data)
    {
        return UserTraining::create($data);
    }

    public function update(UserTraining $userTraining, array $data): UserTraining
    {
        $userTraining->update($data);
        return $userTraining;
    }

    public function delete(UserTraining $userTraining): ?bool
    {
        return $userTraining->delete();
    }
}
