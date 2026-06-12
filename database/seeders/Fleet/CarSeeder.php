<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\Car;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Feature;
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
        $variantData = collect(json_decode(File::get(database_path('data/fleet/variants.json')), true))
            ->keyBy(fn (array $item) => $this->variantKey($item['brand'], $item['model'], $item['name']));
        $features = Feature::all()->keyBy('name');

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
                $car = Car::create([
                    'variant_id' => $variant->id,
                    'location_id' => $item['location_id'],
                    'licence_plate' => $item['licence_plate'],
                    'price_per_day' => $item['price_per_day'],
                    'status' => $item['status'],
                    'production_year' => $item['production_year'],
                    'mileage' => $item['mileage'],
                    'color' => $item['color'],
                    'image' => $item['image'],
                    'description' => $item['description'],
                ]);

                $featureIds = collect($variantData[$this->variantKey($item['brand'], $item['model'], $item['variant'])]['features'] ?? [])
                    ->map(fn ($name) => $features[$name]->id ?? null)
                    ->filter()
                    ->values();

                $car->features()->sync($featureIds);
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

    private function variantKey(string $brand, string $model, string $variant): string
    {
        return "{$brand}|{$model}|{$variant}";
    }
}
