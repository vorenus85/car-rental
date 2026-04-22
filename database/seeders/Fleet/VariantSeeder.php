<?php

namespace Database\Seeders\Fleet;

use App\Models\Fleet\CarModel;
use App\Models\Fleet\Feature;
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

        $features = Feature::all()->keyBy('name');

        foreach ($data as $item) {
            $model = CarModel::where('name', $item['model'])->first();

            if (! $model) {
                continue;
            }

            $variant = Variant::create([
                'name' => $item['name'],
                'model_id' => $model['id'],
                'category' => $item['category'],
                'description' => $item['description'],

                'body_type' => $item['body_type'],
                'transmission' => $item['transmission'],
                'fuel' => $item['fuel'],

                'seats' => $item['seats'],
                'doors' => $item['doors'],
            ]);

            $featureNames = $this->getFeaturesForVariant($item);

            $featureIds = collect($featureNames)
                ->map(fn($name) => $features[$name]->id ?? null)
                ->filter()
                ->values();

            $variant->features()->sync($featureIds);
        }

        $this->command->info('Car variants data seeded successfully!');
    }

    private function getFeaturesForVariant(array $item): array
    {
        $features = [
            'ABS',
            'Electronic Stability Control',
            'Airbags',
        ];

        // economy alap
        if ($item['category'] === 'economy') {
            $features[] = 'Air Conditioning';
            $features[] = 'Bluetooth';
            $features[] = 'USB Ports';
        }

        // compact+
        if (in_array($item['category'], ['compact', 'business', 'premium'])) {
            $features[] = 'Lane Departure Warning';
            $features[] = 'Automatic Emergency Braking';
            $features[] = 'Parking Sensors';
            $features[] = 'Cruise Control';
        }

        // SUV
        if ($item['body_type'] === 'suv') {
            $features[] = 'Rear View Camera';
        }

        // automatic
        if ($item['transmission'] === 'automatic') {
            $features[] = 'Adaptive Cruise Control';
            $features[] = 'Keyless Entry';
            $features[] = 'Keyless Start';
        }

        // hybrid / electric
        if (in_array($item['fuel'], ['hybrid', 'electric'])) {
            $features[] = 'Blind Spot Monitoring';
        }

        // premium
        if ($item['category'] === 'premium') {
            $features[] = 'Leather Seats';
            $features[] = 'Dual-zone Climate Control';
            $features[] = 'Navigation System (GPS)';
        }

        // Tesla kivétel
        if ($item['brand'] === 'Tesla') {
            // nincs CarPlay / Android Auto
        } else {
            if ($item['category'] !== 'economy') {
                $features[] = 'Apple CarPlay';
                $features[] = 'Android Auto';
            }
        }

        // infotainment
        $features[] = 'Touchscreen Display';

        return array_unique($features);
    }
}
