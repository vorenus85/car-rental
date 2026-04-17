<?php

namespace Database\Seeders;

use App\Models\CarModel;
use App\Models\CarVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $path = database_path('data/car_variants.json');
        $data = json_decode(File::get($path), true);

        foreach ($data as $item) {
            $model = CarModel::where('name', $item['model'])->first();

            if (! $model) {
                continue;
            }

            CarVariant::create([
                'name' => $item['name'],
                'model_id' => $model['id'],
                'category' => $item['category'],
                'description' => $item['description'],

                'body_type' => $item['body_type'],
                'transmission' => $item['transmission'],
                'fuel' => $item['fuel'],

                'top_speed' => $item['top_speed'],
                'acceleration' => $item['acceleration'],
                'range' => $item['range'],

                'seats' => $item['seats'],
                'doors' => $item['doors'],
            ]);
        }

        $this->command->info('Car variants data seeded successfully!');
    }
}
