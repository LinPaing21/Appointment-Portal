<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
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
            'date' => $this->faker->date(),
        ];
    }
}
