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
            'email' => 'admin@seaside.com',
            'password' => Hash::make('seasideadmin'), 
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
        
        // Create regular user
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@seaside.com',
            'password' => Hash::make('seasideuser'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);
        
        // Call additional seeders
        $this->call([
            MagicalSkillSeeder::class,
        ]);
    }
}