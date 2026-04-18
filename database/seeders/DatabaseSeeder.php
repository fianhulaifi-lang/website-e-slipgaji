<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama'     => 'Test User',
            'email'    => 'test@example.com',
            'role'     => 'Superadmin',
            'password' => Hash::make('123123123'),
        ]);

               User::create([
            'nama'     => 'Test User',
            'email'    => 'admin@example.com',
            'role'     => 'Admin',
            'password' => Hash::make('12345678'),
        ]);
                   User::create([
            'nama'     => 'Test User',
            'email'    => 'admin2@example.com',
            'role'     => 'Admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
