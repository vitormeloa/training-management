<?php

namespace Database\Seeders;

use App\Models\UserTraining;
use Illuminate\Database\Seeder;

class UserTrainingsTableSeeder extends Seeder
{
    public function run(): void
    {
        UserTraining::factory(20)->create();
    }
}

