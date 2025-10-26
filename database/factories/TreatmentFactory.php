<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text(100),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'patient_id' => fn () => Patient::query()->inRandomOrder()->value('id') ?? Patient::factory(),
            'fisioterapeuta_id' => fn () => User::query()->inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
