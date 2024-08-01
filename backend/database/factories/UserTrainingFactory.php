<?php

namespace Database\Factories;

use App\Models\UserTraining;
use App\Models\User;
use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTrainingFactory extends Factory
{
    protected $model = UserTraining::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'training_id' => Training::factory(),
            'completed' => $this->faker->boolean,
        ];
    }
}
