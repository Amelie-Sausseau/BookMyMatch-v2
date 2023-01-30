<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'scheduled_seats' => rand(1,8),
            'user_id' => 1,
            'company_id' => rand(1, Company::count()),
            'event_id' => rand(1, Event::count()),
            'schedule_date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+ 5 months', $timezone = null)
        ];
    }
}
