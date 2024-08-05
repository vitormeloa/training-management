<?php

namespace Database\Factories;

use App\Models\Subordinate;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubordinateFactory extends Factory
{
    protected $model = Subordinate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
