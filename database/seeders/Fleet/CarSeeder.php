<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\Car;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/fleet/cars.json'));
        $data = json_decode($json, true);

        foreach ($data as $index => $item) {

            $model = CarModel::where('name', $item['model'])->first();
            $variant = Variant::where('name', $item['variant'])->where('model_id', $model['id'])->first();

            if (!$variant) {
                dd([
                    'error' => 'Variant not found',
                    'index' => $index,
                    'item' => $item,
                ]);
            }

            try {
                Car::create([
                    'variant_id' => $variant->id,
                    'licence_plate' => $item['licence_plate'],
                    'price_per_day' => $item['price_per_day'],
                    'status' => $item['status'],
                    'production_year' => $item['production_year'],
                    'mileage' => $item['mileage'],
                    'color' => $item['color'],
                    'image' => $item['image'],
                    'description' => $item['description'],
                ]);
            } catch (\Exception $e) {
                dd([
                    'error' => 'Insert failed',
                    'index' => $index,
                    'item' => $item,
                    'message' => $e->getMessage(),
                ]);
            }
        }

        $this->command->info('Cars data seeded successfully!');
    }
}
