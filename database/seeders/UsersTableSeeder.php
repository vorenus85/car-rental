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
            'phone' => '123-456-7890',
            'password' => Hash::make(env('ADMIN_USER_PWD')),
            'active' => true,
        ]);

        $json = File::get(database_path('data/users.json'));
        $users = json_decode($json, true);

        // Populate with data
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'active' => $user['active'],
                'password' => Hash::make(strtolower($user['name'])),
            ]);
        }

        $this->command->info('Users data seeded successfully!');
    }
}
