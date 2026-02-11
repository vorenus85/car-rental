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
        $authors = json_decode($json, true);

        // Populate with data
        foreach ($authors as $author) {
            Color::create([
                'name' => $author['name'],
                'hex_code' => $author['hex_code'],
            ]);
        }

        $this->command->info('Colors data seeded successfully!');
    }
}
