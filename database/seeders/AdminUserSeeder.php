<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@solstay.es'],
            [
                'name' => 'Admin SolStay',
                'password' => bcrypt('password'),
                'phone' => '+34 612 345 678',
                'locale' => 'es',
                'is_admin' => true,
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'maria@example.com'],
            [
                'name' => 'María García',
                'password' => bcrypt('password'),
                'phone' => '+34 655 123 456',
                'locale' => 'es',
                'is_admin' => false,
                'email_verified_at' => now(),
            ],
        );
    }
}
