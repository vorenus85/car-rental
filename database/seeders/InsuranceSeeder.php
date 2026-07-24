<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(database_path('data/insurances.json'));
        $data = json_decode($json, true);

        // Populate with data
        foreach ($data as $index => $item) {
            Insurance::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'recommended' => $item['recommended'],
            ]);
        }

        $this->command->info('Insurances data seeded successfully!');
    }
}
