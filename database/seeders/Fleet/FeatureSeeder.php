<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(database_path('data/fleet/features.json'));
        $data = json_decode($json, true);

        // Populate with data
        foreach ($data as $item) {
            Feature::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'category' => $item['category'],
            ]);
        }

        $this->command->info('Features data seeded successfully!');
    }
}
