<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\Location;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $path = database_path('data/fleet/locations.json');
        $data = json_decode(File::get($path), true);

        foreach ($data as $item) {
            Location::create($item);
        }

        $this->command->info('Locations data seeded successfully!');
    }
}
