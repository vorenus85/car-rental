<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $path = database_path('data/brands_with_models.json');
        $data = json_decode(File::get($path), true);

        foreach ($data as $item) {
            $brand = Brand::where('name', $item['name'])->first();

            if (! $brand) {
                continue; // vagy throw Exception
            }

            $carModels = $item["models"];

            foreach ($carModels as $carModel) {
                CarModel::create([
                    'name' => $carModel,
                    'brand_id' => $brand['id'],
                ]);
            }

        }

        $this->command->info('CarModels data seeded successfully!');
    }
}
