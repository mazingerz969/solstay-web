<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SolStay',
            'email' => 'admin@solstay.es',
            'password' => bcrypt('password'),
            'phone' => '+34 612 345 678',
            'locale' => 'es',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'María García',
            'email' => 'maria@example.com',
            'password' => bcrypt('password'),
            'phone' => '+34 655 123 456',
            'locale' => 'es',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);
    }
}
