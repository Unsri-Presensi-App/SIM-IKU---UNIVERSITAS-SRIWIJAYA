<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * UserSeeder
 * ------------------------------------------------------------------
 * Membuat akun awal SIM-IKU dengan beragam peran (role):
 *  - admin     : akses penuh
 *  - operator  : input data IKU di unitnya
 *  - validator : Direktorat, memvalidasi ajuan
 *  - viewer    : hanya melihat dashboard
 * Registrasi publik dinonaktifkan; akun ditambah manual via seeder ini.
 * updateOrInsert → aman dijalankan ulang.
 * ------------------------------------------------------------------
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['email' => 'admin@unsri.ac.id',     'name' => 'Admin UNSRI',          'role' => 'admin',     'unit_kerja' => 'Universitas', 'password' => 'SimIkuUnsri123'],
            ['email' => 'operator.ft@unsri.ac.id','name' => 'Operator Fak. Teknik',  'role' => 'operator',  'unit_kerja' => 'FT',          'password' => 'OperatorFT123'],
            ['email' => 'operator.fe@unsri.ac.id','name' => 'Operator Fak. Ekonomi', 'role' => 'operator',  'unit_kerja' => 'FE',          'password' => 'OperatorFE123'],
            ['email' => 'validator@unsri.ac.id',  'name' => 'Validator Direktorat',  'role' => 'validator', 'unit_kerja' => 'Universitas', 'password' => 'Validator123'],
            ['email' => 'viewer@unsri.ac.id',     'name' => 'Pengamat Eksekutif',    'role' => 'viewer',    'unit_kerja' => 'Universitas', 'password' => 'Viewer123456'],
        ];

        foreach ($akun as $a) {
            DB::table('users')->updateOrInsert(
                ['email' => $a['email']],
                [
                    'name'       => $a['name'],
                    'role'       => $a['role'],
                    'unit_kerja' => $a['unit_kerja'],
                    'password'   => Hash::make($a['password']),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $this->command->info('Akun SIM-IKU siap (admin/operator/validator/viewer) - lihat UserSeeder.');
    }
}