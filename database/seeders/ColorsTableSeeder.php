<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(database_path('data/colors.json'));
        $data = json_decode($json, true);

        // Populate with data
        foreach ($data as $item) {
            Color::create([
                'name' => $item['name'],
                'hex_code' => $item['hex_code'],
            ]);
        }

        $this->command->info('Colors data seeded successfully!');
    }
}
