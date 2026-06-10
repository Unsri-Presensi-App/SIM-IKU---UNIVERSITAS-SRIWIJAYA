<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IkuSatuSeeder extends Seeder
{
    public function run(): void
    {
        // Data dummy berdasarkan contoh di PDF Kepmendiktisaintek 358/2026
        $data = [
            [
                'nama_program'      => 'Diploma Tiga (D3)',
                'jenjang'           => 'D3',
                'total_mahasiswa'   => 200,
                'lulus_tepat_waktu' => 60,
                'aee_realisasi'     => 30.00,
                'aee_ideal'         => 33.00,
                'tingkat_pencapaian'=> 90.91,
                'tahun_akademik'    => 2024,
            ],
            [
                'nama_program'      => 'Diploma Empat (D4)',
                'jenjang'           => 'D4',
                'total_mahasiswa'   => 300,
                'lulus_tepat_waktu' => 60,
                'aee_realisasi'     => 20.00,
                'aee_ideal'         => 25.00,
                'tingkat_pencapaian'=> 80.00,
                'tahun_akademik'    => 2024,
            ],
            [
                'nama_program'      => 'Sarjana (S1)',
                'jenjang'           => 'S1',
                'total_mahasiswa'   => 1500,
                'lulus_tepat_waktu' => 300,
                'aee_realisasi'     => 20.00,
                'aee_ideal'         => 25.00,
                'tingkat_pencapaian'=> 80.00,
                'tahun_akademik'    => 2024,
            ],
            [
                'nama_program'      => 'Magister (S2)',
                'jenjang'           => 'S2',
                'total_mahasiswa'   => 400,
                'lulus_tepat_waktu' => 180,
                'aee_realisasi'     => 45.00,
                'aee_ideal'         => 50.00,
                'tingkat_pencapaian'=> 90.00,
                'tahun_akademik'    => 2024,
            ],
            [
                'nama_program'      => 'Doktor (S3)',
                'jenjang'           => 'S3',
                'total_mahasiswa'   => 110,
                'lulus_tepat_waktu' => 33,
                'aee_realisasi'     => 30.00,
                'aee_ideal'         => 33.00,
                'tingkat_pencapaian'=> 90.91,
                'tahun_akademik'    => 2024,
            ],
        ];

        DB::table('iku_satu')->insert($data);
    }
}