<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $path = database_path('data/fleet/variants.json');
        $data = json_decode(File::get($path), true);

        foreach ($data as $item) {
            $model = CarModel::where('name', $item['model'])->first();

            if (! $model) {
                continue;
            }

            Variant::create([
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
