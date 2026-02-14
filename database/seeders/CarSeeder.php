<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(database_path('data/cars.json'));
        $data = json_decode($json, true);

        // Populate with data
        foreach ($data as $item) {

            $model = CarModel::where('name', $item['model_name'])->first();

            if (!$model) {
                throw new \Exception("Model not found: " . $item['model_name']. ", licence_plate". $item['licence_plate']);
            }

            Car::create([
                'model_id' => $model['id'],
                'licence_plate' => $item['licence_plate'],
                'image' => $item['image'],
                'price_per_day' => $item['price_per_day'],
                'body_type' => $item['body_type'],
                'transmission' => $item['transmission'],
                'fuel' => $item['fuel'],
                'status' => $item['status'],
                'production_year' => $item['production_year'],
                'top_speed' => $item['top_speed'],
                'acceleration' => $item['acceleration'],
                'range' => $item['range'],
                'description' => $item['description'],
            ]);
        }

        $this->command->info('Cars data seeded successfully!');
    }
}
