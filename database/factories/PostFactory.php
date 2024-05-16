<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'title' => fake()->title(),
            'slug' => fake()->slug,
            'content' => json_encode([
                'time' => '1714074280691'
            ]),
            'likes' => fake()->randomNumber(),
            'dislikes' => fake()->randomNumber()
        ];
    }
}
