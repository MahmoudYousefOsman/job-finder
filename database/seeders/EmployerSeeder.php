<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(100)
            ->has(
                Job::factory(50)
                    ->has(
                        Skill::factory(5)
                    ),
                'jobs'
            )
            ->create();
    }
}
