<?php

namespace Database\Seeders;

use Database\Seeders\Fleet\BrandSeeder;
use Database\Seeders\Fleet\CarModelSeeder;
use Database\Seeders\Fleet\CarSeeder;
use Database\Seeders\Fleet\FeatureSeeder;
use Database\Seeders\Fleet\VariantSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UsersTableSeeder::class,
            FeatureSeeder::class,
            BrandSeeder::class,
            CarModelSeeder::class,
            VariantSeeder::class,
            CarSeeder::class,
        ]);

        $this->command->info('All data seeded successfully!');
    }
}
