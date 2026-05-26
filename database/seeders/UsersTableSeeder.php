<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // demo admin user
        User::factory()->create([
            'name' => 'Admin user',
            'email' => env('ADMIN_USER_EMAIL'),
            'phone' => 1234567890,
            'password' => Hash::make(env('ADMIN_USER_PWD')),
        ]);

        $this->command->info('Users data seeded successfully!');
    }
}
