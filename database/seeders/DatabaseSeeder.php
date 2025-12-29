<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Angkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'user', // Assuming test user is not admin
            ]
        );

        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Create sample angkatan
        Angkatan::updateOrCreate(
            ['nama_angkatan' => 'Angkatan 2023'],
            [
                'tahun' => 2023,
                'motto' => 'Bersama Membangun Masa Depan',
                'filosofi' => 'Kami adalah angkatan yang berkomitmen untuk membangun masa depan yang lebih baik melalui pendidikan dan kolaborasi.',
            ]
        );
    }
}
