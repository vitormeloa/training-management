<?php

namespace Database\Seeders;

use App\Models\Training;
use Illuminate\Database\Seeder;

class TrainingsTableSeeder extends Seeder
{
    public function run(): void
    {
        Training::factory(10)->create();
    }
}

