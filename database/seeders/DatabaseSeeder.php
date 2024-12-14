<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Kamrul Hasan',
                'email' => 'kamrul@gmail.com',
                'role' => 'user',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Zahin',
                'email' => 'zahin@gmail.com',
                'role' => 'user',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Mushfiqur Mashuk',
                'email' => 'mushfiq@gmail.com',
                'role' => 'user',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
