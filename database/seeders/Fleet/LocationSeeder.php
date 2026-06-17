<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\City;
use App\Models\Fleet\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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
            $city = City::firstOrCreate(['name' => $item['city']]);

            $item['city_id'] = $city->id;
            unset($item['city']);

            Location::create($item);
        }

        $this->command->info('Locations data seeded successfully!');
    }
}
