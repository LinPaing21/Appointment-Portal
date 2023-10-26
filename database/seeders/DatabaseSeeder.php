<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Docter;
use App\Models\History;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Specialize;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create([
            'user_role' => 'a'
        ]);

        Docter::factory(2)->create([
            'speciality' => 'General Docter'
        ]);

        Docter::factory()->create([
            'speciality' => 'Child Specialist'
        ]);

        Docter::factory()->create([
            'speciality' => 'Dentist'
        ]);

        Patient::factory(6)->create();

        Schedule::factory()->create([
            'start_time' => '2023-10-27 08:37:17',
            'accept' => true
        ]);

        Schedule::factory()->create([
            'start_time' => '2023-10-27 14:37',
        ]);

        Schedule::factory()->create([
            'start_time' => '2023-10-26 10:37:17',
            'accept' => true
        ]);

        Schedule::factory()->create([
            'start_time' => '2023-10-25 14:37',
            'accept' => true
        ]);

        Schedule::factory()->create([
            'start_time' => '2023-10-24 10:37:17',
        ]);

        Schedule::factory(3)->create([
            'start_time' => '2023-10-27 04:37',
        ]);

        History::factory(5)->create();
    }
}
