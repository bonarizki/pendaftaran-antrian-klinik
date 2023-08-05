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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'dokter',
            'email' => 'dokter@gmail.com',
            'phone_number' => '0123456789012',
            'role' => 'dokter',
            'password' =>  Hash::make('dokter123')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'apoteker',
            'email' => 'apoteker@gmail.com',
            'phone_number' => '0123456789013',
            'role' => 'apoteker',
            'password' =>  Hash::make('apoteker123')
        ]);
    }
}
