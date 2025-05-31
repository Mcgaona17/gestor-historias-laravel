<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sprint;

class SprintSeeder extends Seeder
{
    public function run(): void
    {
        Sprint::create(['name' => 'Sprint 1']);
        Sprint::create(['name' => 'Sprint 2']);
        Sprint::create(['name' => 'Sprint 3']);
    }
}
