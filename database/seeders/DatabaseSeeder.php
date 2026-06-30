<?php

namespace Database\Seeders;

use Database\Seeders\Fleet\BrandSeeder;
use Database\Seeders\Fleet\CarModelSeeder;
use Database\Seeders\Fleet\CarSeeder;
use Database\Seeders\Fleet\CitySeeder;
use Database\Seeders\Fleet\FeatureSeeder;
use Database\Seeders\Fleet\LocationSeeder;
use Database\Seeders\Fleet\VariantSeeder;
use Database\Seeders\CustomerSeeder;
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
            CitySeeder::class,
            LocationSeeder::class,
            FeatureSeeder::class,
            BrandSeeder::class,
            CarModelSeeder::class,
            VariantSeeder::class,
            CarSeeder::class,
            CustomerSeeder::class,
        ]);

        $this->command->info('All data seeded successfully!');
    }
}
