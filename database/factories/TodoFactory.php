<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\LaravelIgnition\Support\Composer\FakeComposer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 0,
            'title' => fake()->sentence(),
            'description' => fake()->sentences(3),
            'completed_at' => fake()->randomElement([0,0,0,0,1]) ? fake()->dateTimeBetween('-1 day', '-1 month') : null,
        ];
    }
}
