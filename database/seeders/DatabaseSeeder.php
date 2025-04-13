<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@webmaster.com',
            'password' => Hash::make('webmasteradmin'), 
            'email_verified_at' => now(),
        ]);
        }
}