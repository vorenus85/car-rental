<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(database_path('data/brands_with_models.json'));
        $data = json_decode($json, true);

        // Populate with data
        foreach ($data as $item) {
            Brand::create([
                'name' => $item['name'],
                'logo' => $item['logo'],
            ]);
        }

        $this->command->info('Brands data seeded successfully!');
    }
}
