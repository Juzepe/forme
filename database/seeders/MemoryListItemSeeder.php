<?php

namespace Database\Seeders;

use App\Models\MemoryList;
use App\Models\MemoryListItem;
use Illuminate\Database\Seeder;

class MemoryListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all memory lists
        $memoryLists = MemoryList::all();
        
        if ($memoryLists->isEmpty()) {
            $this->command->warn('No memory lists found. Please run MemoryListSeeder first.');
            return;
        }

        // Create items for each memory list
        foreach ($memoryLists as $memoryList) {
            // Create 3-8 items per memory list
            $itemCount = rand(3, 8);
            
            for ($i = 0; $i < $itemCount; $i++) {
                MemoryListItem::factory()
                    ->forMemoryList($memoryList)
                    ->atPosition($i + 1)
                    ->create();
            }
        }

        // Create specific items for example lists
        $shoppingList = MemoryList::where('title', 'Shopping List')->first();
        if ($shoppingList) {
            $shoppingItems = [
                'Milk',
                'Bread',
                'Eggs',
                'Bananas',
                'Chicken breast',
                'Rice',
                'Tomatoes',
                'Cheese',
            ];

            foreach ($shoppingItems as $index => $item) {
                MemoryListItem::factory()
                    ->forMemoryList($shoppingList)
                    ->atPosition($index + 1)
                    ->create(['content' => $item]);
            }
        }

        $todoList = MemoryList::where('title', 'Todo List')->first();
        if ($todoList) {
            $todoItems = [
                'Complete project proposal',
                'Call dentist for appointment',
                'Pay electricity bill',
                'Clean garage',
                'Buy birthday gift for mom',
                'Schedule car maintenance',
            ];

            foreach ($todoItems as $index => $item) {
                MemoryListItem::factory()
                    ->forMemoryList($todoList)
                    ->atPosition($index + 1)
                    ->create(['content' => $item]);
            }
        }

        $readingList = MemoryList::where('title', 'Reading List')->first();
        if ($readingList) {
            $readingItems = [
                'The Great Gatsby by F. Scott Fitzgerald',
                '1984 by George Orwell',
                'To Kill a Mockingbird by Harper Lee',
                'Pride and Prejudice by Jane Austen',
                'The Catcher in the Rye by J.D. Salinger',
            ];

            foreach ($readingItems as $index => $item) {
                MemoryListItem::factory()
                    ->forMemoryList($readingList)
                    ->atPosition($index + 1)
                    ->create(['content' => $item]);
            }
        }

        $this->command->info('Memory list items seeded successfully!');
    }
}
