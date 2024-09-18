<?php

namespace Database\Factories;

use App\Enums\ExperienceLevelEnum;
use App\Enums\WorkTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'location' => $this->faker->address(),
            'expired_at' => now()->add('day', $this->faker->numberBetween(0, 30)),
            'responsibilities' => $this->faker->text(),
            'category_id' => $this->faker->numberBetween(1, 100),
            'salary_start' => $this->faker->numberBetween(1000, 10000),
            'salary_end' => $this->faker->numberBetween(1000, 10000),
            'experience_leve' => $this->faker->randomElement(ExperienceLevelEnum::cases()),
            'work_type' => $this->faker->randomElement(WorkTypeEnum::cases()),
        ];
    }
}
