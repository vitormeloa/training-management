<?php

namespace Database\Seeders;

use App\Models\SubordinateTraining;
use Illuminate\Database\Seeder;

class SubordinateTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubordinateTraining::factory(10)->create();
    }
}
