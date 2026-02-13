<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add GR Tech default users
        // Since no password is set, so default value will be 'password'
        User::factory()
            ->count(2)
            ->sequence(
                ['name' => 'Admin', 'email' => 'admin@grtech.com'],
                ['name' => 'User', 'email' => 'user@grtech.com'],
            )
            ->create();
    }
}
