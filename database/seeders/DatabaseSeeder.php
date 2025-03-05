<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            Article13Seeder::class,
            Article17Seeder::class,
            Article18Seeder::class,
            Article19Seeder::class,
            Article21Seeder::class,
            Article23Seeder::class,
            BusinessTypeSeeder::class,
            BusinessTypeSeeder::class,
            TimeVisitSeeder::class
        ]);

    }
}
