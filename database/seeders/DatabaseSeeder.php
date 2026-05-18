<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin jika belum ada
        if (!User::where('email', 'admin@smartschedule.com')->exists()) {
            User::create([
                'name' => 'Admin Sekolah',
                'email' => 'admin@smartschedule.com',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]);
            $this->command->info('Admin berhasil dibuat!');
        }
    }
}