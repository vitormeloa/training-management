<?php

namespace Database\Seeders;

use App\Models\Subordinate;
use Illuminate\Database\Seeder;

class SubordinateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subordinate::factory(10)->create();
    }
}
