<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemoryList>
 */
class MemoryListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'description' => fake()->optional(0.7)->sentence(),
        ];
    }

    /**
     * Create a memory list with a specific user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Create a memory list with a short title.
     */
    public function shortTitle(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => fake()->word(),
        ]);
    }

    /**
     * Create a memory list with a long title.
     */
    public function longTitle(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => fake()->sentence(6),
        ]);
    }

    /**
     * Create a memory list without description.
     */
    public function withoutDescription(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => null,
        ]);
    }
}
