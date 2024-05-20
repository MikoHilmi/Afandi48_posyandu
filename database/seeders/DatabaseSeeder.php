<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AplikasiSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'Admininstrator',
            'email' => 'admin@admin.com',
            'role' => 1,
            'password' => Hash::make('administrator'),
        ]);
    }
}
