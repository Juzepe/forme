<?php

namespace Database\Factories;

use App\Models\MemoryList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemoryListItem>
 */
class MemoryListItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'memory_list_id' => MemoryList::factory(),
            'content' => fake()->sentence(),
            'position' => fake()->numberBetween(1, 100),
        ];
    }

    /**
     * Create a memory list item for a specific memory list.
     */
    public function forMemoryList(MemoryList $memoryList): static
    {
        return $this->state(fn (array $attributes) => [
            'memory_list_id' => $memoryList->id,
        ]);
    }

    /**
     * Create a memory list item with short content.
     */
    public function shortContent(): static
    {
        return $this->state(fn (array $attributes) => [
            'content' => fake()->word(),
        ]);
    }

    /**
     * Create a memory list item with long content.
     */
    public function longContent(): static
    {
        return $this->state(fn (array $attributes) => [
            'content' => fake()->paragraph(),
        ]);
    }

    /**
     * Create a memory list item with a specific position.
     */
    public function atPosition(int $position): static
    {
        return $this->state(fn (array $attributes) => [
            'position' => $position,
        ]);
    }

    /**
     * Create a memory list item with sequential positions starting from 1.
     */
    public function sequential(): static
    {
        static $position = 1;
        
        return $this->state(fn (array $attributes) => [
            'position' => $position++,
        ]);
    }
}
