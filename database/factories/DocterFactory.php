<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['user_role' => 'd']),
            'phone' => $this->faker->e164PhoneNumber(),
            'license' => $this->faker->ean8(),
            'speciality' => $this->faker->sentence()
        ];
    }
}
