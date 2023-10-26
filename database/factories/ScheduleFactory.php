<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'docter_id' => rand(1, 4),
            'patient_id' => rand(1,6),
            'title' => $this->faker->sentence(),
            'start_time' => '2023-10-25 08:37',
        ];
    }
}
