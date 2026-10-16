<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'name' => $this->faker->words(3, true),
            'event_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'location' => $this->faker->city(),
            'slug' => $this->faker->slug(),
            'expires_at' => $this->faker->dateTimeBetween('now', '+6 months'),
        ];
    }
}
