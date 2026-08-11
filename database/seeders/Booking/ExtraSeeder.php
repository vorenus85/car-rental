<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\Extra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(database_path('data/extras.json'));
        $data = json_decode($json, true);

        // Populate with data
        foreach ($data as $index => $item) {
            Extra::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'icon' => $item['icon'],
                'maxQuantity' => $item['maxQuantity'],
            ]);
        }

        $this->command->info('Extras data seeded successfully!');
    }
}
