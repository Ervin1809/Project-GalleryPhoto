<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(rand(3, 6)),
            'description' => fake()->optional()->paragraph(),
            'file_low_res' => 'images/low_res/dummy.jpg',  // Placeholder
            'file_high_res' => 'images/high_res/dummy.jpg', // Placeholder
            'uploaded_by' => User::where('role', 'admin')->first()->id ?? 1,
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
