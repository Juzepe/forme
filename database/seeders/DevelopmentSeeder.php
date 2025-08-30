<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the development seeds.
     * This seeder is intended for development environments only.
     */
    public function run(): void
    {
        $this->command->info('Seeding development data...');

        // Seed memory lists and items for development
        $this->call([
            MemoryListSeeder::class,
            MemoryListItemSeeder::class,
        ]);

        $this->command->info('Development data seeded successfully!');
    }
}
