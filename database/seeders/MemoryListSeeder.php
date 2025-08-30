<?php

namespace Database\Seeders;

use App\Models\MemoryList;
use App\Models\User;
use Illuminate\Database\Seeder;

class MemoryListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users or create some if none exist
        $users = User::all();
        
        if ($users->isEmpty()) {
            $users = User::factory(3)->create();
        }

        // Create memory lists for each user
        foreach ($users as $user) {
            // Create 2-5 memory lists per user
            $listCount = rand(2, 5);
            
            for ($i = 0; $i < $listCount; $i++) {
                MemoryList::factory()
                    ->forUser($user)
                    ->create();
            }
        }

        // Create some specific example memory lists
        $firstUser = $users->first();
        
        if ($firstUser) {
            // Create a shopping list
            MemoryList::factory()
                ->forUser($firstUser)
                ->create([
                    'title' => 'Shopping List',
                    'description' => 'Weekly grocery shopping items',
                ]);

            // Create a todo list
            MemoryList::factory()
                ->forUser($firstUser)
                ->create([
                    'title' => 'Todo List',
                    'description' => 'Tasks to complete this week',
                ]);

            // Create a reading list
            MemoryList::factory()
                ->forUser($firstUser)
                ->create([
                    'title' => 'Reading List',
                    'description' => 'Books I want to read',
                ]);
        }

        $this->command->info('Memory lists seeded successfully!');
    }
}
