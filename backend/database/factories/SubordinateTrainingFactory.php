<?php

namespace Database\Factories;

use App\Models\Subordinate;
use App\Models\Training;
use App\Models\SubordinateTraining;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubordinateTrainingFactory extends Factory
{
    protected $model = SubordinateTraining::class;

    public function definition(): array
    {
        return [
            'subordinate_id' => Subordinate::factory(),
            'training_id' => Training::factory(),
            'completed' => $this->faker->boolean,
        ];
    }
}
