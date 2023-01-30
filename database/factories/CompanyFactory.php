<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company($maxNbChars = 20),
            'image' => 'Rectangle 65.png',
            'available_seats' => mt_rand(0,150),
            'user_id' => rand(1, User::count()),
            'address' => $this->faker->address(),
            'city' => 'La Rochelle',
            'postal_code' => '17000',
            'opening_hours' => 'Du mardi au samedi de 17h à 2h'
        ];
    }
}
