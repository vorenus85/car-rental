<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $json = File::get(database_path('data/features.json'));
        $authors = json_decode($json, true);

        // Populate with data
        foreach ($authors as $author) {
            Feature::create([
                'name' => $author['name'],
                'description' => $author['description'],
            ]);
        }

        $this->command->info('Features data seeded successfully!');
    }
}
