<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Budapest', 'Vienna', 'Prague'] as $name) {
            City::firstOrCreate(['name' => $name]);
        }

        $this->command->info('Cities data seeded successfully!');
    }
}
