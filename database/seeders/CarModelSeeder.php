<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data/car_models.json');
        $data = json_decode(File::get($path), true);

        foreach ($data as $item) {
            $brand = Brand::where('name', $item['brand'])->first();

            if (! $brand) {
                continue;
            }

            $carModels = $item["models"];

            foreach ($carModels as $carModel) {
                CarModel::create([
                    'name' => $carModel['name'],
                    'brand_id' => $brand['id'],
                    'description' => $carModel['description'],
                ]);
            }
        }

        $this->command->info('Car models data seeded successfully!');
    }
}
