<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * UserSeeder
 * ------------------------------------------------------------------
 * Membuat akun administrator awal untuk SIM-IKU.
 * Registrasi publik dinonaktifkan, sehingga akun ditambahkan manual
 * lewat seeder ini. Gunakan updateOrInsert agar aman dijalankan ulang
 * (tidak menduplikasi user yang sudah ada).
 * ------------------------------------------------------------------
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@unsri.ac.id'],
            [
                'name'       => 'Admin UNSRI',
                'password'   => Hash::make('SimIkuUnsri123'),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $this->command->info('✅ Akun admin SIM-IKU siap: admin@unsri.ac.id');
    }
}