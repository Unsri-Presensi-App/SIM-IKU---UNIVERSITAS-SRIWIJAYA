<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Kosongkan tabel agar tidak duplikasi saat di-seed ulang.
        Schema::disableForeignKeyConstraints();
        DB::table('target_iku')->truncate();
        DB::table('target_fakultas')->truncate();
        DB::table('realisasi_iku')->truncate();
        Schema::enableForeignKeyConstraints();

        // ==================================================
        // DATA IKU UTAMA (Baseline 2025 & Target 2026)
        // SUMBER RESMI: matriks Kontrak Kinerja Rektor (PDF hal.2-4).
        // Catatan: angka sub-IKU AEE per jenjang di bawah mengikuti MATRIKS PK,
        // BUKAN slide "Rekap Pencapaian AEE PT" (yang skalanya normalisasi).
        // ==================================================
        $ikuData = [
            [
                'kode_iku'      => 'IKU 1',
                'nama_iku'      => 'Angka Efisiensi Edukasi Perguruan Tinggi (AEE PT)',
                'baseline_2025' => 42.53,
                'target_2026'   => 43.13,   // <-- TARGET RESMI AEE PT (matriks PK)
                'satuan'        => '%',
                'keterangan'    => 'Rata-rata AEE seluruh jenjang',
            ],
            [
                'kode_iku'      => 'IKU 1_D3',
                'nama_iku'      => 'AEE - Diploma Tiga',
                'baseline_2025' => 51.30,   // matriks PK hal.2
                'target_2026'   => 51.50,
                'satuan'        => '%',
                'keterangan'    => 'Target AEE khusus D3 (matriks PK Rektor)',
            ],
            [
                'kode_iku'      => 'IKU 1_S1',
                'nama_iku'      => 'AEE - Sarjana',
                'baseline_2025' => 49.70,
                'target_2026'   => 50.00,
                'satuan'        => '%',
                'keterangan'    => 'Target AEE khusus S1 (matriks PK Rektor)',
            ],
            [
                'kode_iku'      => 'IKU 1_S2',
                'nama_iku'      => 'AEE - Magister',
                'baseline_2025' => 38.50,
                'target_2026'   => 40.00,
                'satuan'        => '%',
                'keterangan'    => 'Target AEE khusus S2 (matriks PK Rektor)',
            ],
            [
                'kode_iku'      => 'IKU 1_S3',
                'nama_iku'      => 'AEE - Doktor',
                'baseline_2025' => 30.60,
                'target_2026'   => 31.00,
                'satuan'        => '%',
                'keterangan'    => 'Target AEE khusus S3 (matriks PK Rektor)',
            ],
            [
                'kode_iku'      => 'IKU 2',
                'nama_iku'      => 'Lulusan Langsung Bekerja/Melanjutkan/Berwirausaha',
                'baseline_2025' => 73.60,
                'target_2026'   => 75.00,
                'satuan'        => '%',
                'keterangan'    => 'Status lulusan 1 tahun setelah lulus (tabel PJ hal.20)',
            ],
            [
                'kode_iku'      => 'IKU 3',
                'nama_iku'      => 'Mahasiswa Berkegiatan/Prestasi di Luar Prodi',
                'baseline_2025' => 14.90,
                'target_2026'   => 35.00,
                'satuan'        => '%',
                'keterangan'    => 'Matriks PK Wajib (kontrak rektor)',
            ],
            [
                'kode_iku'      => 'IKU 4',
                'nama_iku'      => 'Dosen Mendapat Rekognisi Internasional',
                'baseline_2025' => 37.33,
                'target_2026'   => 45.00,   // matriks PK Wajib hal.2 = 44,6%
                'satuan'        => '%',
                'keterangan'    => 'Target: 784 dosen mendapat rekognisi',
            ],
            [
                'kode_iku'      => 'IKU 4_S3',
                'nama_iku'      => 'Dosen Berpendidikan S3',
                'baseline_2025' => 29.75,
                'target_2026'   => 39.60,
                'satuan'        => '%',
                'keterangan'    => 'Target: 689 dosen S3',
            ],
            [
                'kode_iku'      => 'IKU 5',
                'nama_iku'      => 'Luaran Kerjasama PT dengan Startup/Industri/Lembaga',
                'baseline_2025' => 0.58,
                'target_2026'   => 5.00,
                'satuan'        => '%',
                'keterangan'    => 'Target: 87 luaran kerjasama',
            ],
            [
                'kode_iku'      => 'IKU 6',
                'nama_iku'      => 'Publikasi Bereputasi Internasional (Scopus/WoS)',
                'baseline_2025' => 590,
                'target_2026'   => 708,
                'satuan'        => 'Artikel',
                'keterangan'    => 'Total publikasi internasional',
            ],
            [
                'kode_iku'      => 'IKU 7',
                'nama_iku'      => 'Keterlibatan PT dalam SDGs',
                'baseline_2025' => 36.00,
                'target_2026'   => 55.00,
                'satuan'        => '%',
                'keterangan'    => 'SDG 1, 4, 17, 6, dan 13',
            ],
            [
                'kode_iku'      => 'IKU 8',
                'nama_iku'      => 'SDM Terlibat Penyusunan Kebijakan',
                'baseline_2025' => 5.00,
                'target_2026'   => 25.00,
                'satuan'        => '%',
                'keterangan'    => 'Target: 436 dosen/peneliti',
            ],
            [
                'kode_iku'      => 'IKU 9',
                'nama_iku'      => 'Pendapatan Non Pendidikan/UKT',
                'baseline_2025' => 13.30,
                'target_2026'   => 15.00,
                'satuan'        => '%',
                'keterangan'    => 'Dari total pendapatan perguruan tinggi',
            ],
            [
                'kode_iku'      => 'IKU 10',
                'nama_iku'      => 'Usulan Zona Integritas WBK/WBBM',
                'baseline_2025' => 0.00,    // matriks PK hal.4: baseline 0
                'target_2026'   => 2.00,
                'satuan'        => 'Unit Kerja',
                'keterangan'    => 'Usulan unit kerja baru',
            ],
            [
                'kode_iku'      => 'IKU 11_WTP',
                'nama_iku'      => 'Opini WTP atas Laporan Keuangan',
                'baseline_2025' => null,
                'target_2026'   => null,
                'satuan'        => 'Opini',
                'keterangan'    => 'WTP',    // nilai dipakai langsung oleh controller
            ],
            [
                'kode_iku'      => 'IKU 11_SAKIP',
                'nama_iku'      => 'Predikat SAKIP',
                'baseline_2025' => null,
                'target_2026'   => null,
                'satuan'        => 'Predikat',
                'keterangan'    => 'AA',
            ],
        ];

        foreach ($ikuData as $iku) {
            DB::table('target_iku')->insert(array_merge($iku, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // ==================================================
        // DATA TARGET PER FAKULTAS
        // ==================================================

        // 1. AEE D3 (IKU 1_D3) - Sumber: PDF AEE D3
        $aeeD3Fakultas = [
            ['fakultas' => 'FE',       'baseline_2025' => 33.49, 'target_2026' => 52.09],
            ['fakultas' => 'FASILKOM', 'baseline_2025' => 22.19, 'target_2026' => 52.02],
        ];
        foreach ($aeeD3Fakultas as $data) {
            DB::table('target_fakultas')->insert([
                'kode_iku' => 'IKU 1_D3', 'fakultas' => $data['fakultas'],
                'baseline_2025' => $data['baseline_2025'], 'target_2026' => $data['target_2026'],
                'satuan' => '%', 'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 2. AEE S1 (IKU 1_S1) - Sumber: PDF AEE S1 Baseline & Target per fakultas
        $aeeS1Fakultas = [
            ['fakultas' => 'FE',       'baseline_2025' => 64.02, 'target_2026' => 70.42],
            ['fakultas' => 'FH',       'baseline_2025' => 58.94, 'target_2026' => 64.84],
            ['fakultas' => 'FT',       'baseline_2025' => 33.44, 'target_2026' => 36.78],
            ['fakultas' => 'FK',       'baseline_2025' => 72.96, 'target_2026' => 80.26],
            ['fakultas' => 'FP',       'baseline_2025' => 52.61, 'target_2026' => 57.87],
            ['fakultas' => 'FKIP',     'baseline_2025' => 56.57, 'target_2026' => 62.23],
            ['fakultas' => 'FISIP',    'baseline_2025' => 48.55, 'target_2026' => 53.41],
            ['fakultas' => 'FMIPA',    'baseline_2025' => 70.19, 'target_2026' => 77.21],
            ['fakultas' => 'FASILKOM', 'baseline_2025' => 58.15, 'target_2026' => 63.96],
            ['fakultas' => 'FKM',      'baseline_2025' => 50.89, 'target_2026' => 55.98],
        ];
        foreach ($aeeS1Fakultas as $data) {
            DB::table('target_fakultas')->insert([
                'kode_iku' => 'IKU 1_S1', 'fakultas' => $data['fakultas'],
                'baseline_2025' => $data['baseline_2025'], 'target_2026' => $data['target_2026'],
                'satuan' => '%', 'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 3. IKU 2 - Sumber: PDF tabel per fakultas
        $iku2Fakultas = [
            ['fakultas' => 'FE',       'baseline_2025' => 65.33, 'target_2026' => 67.33],
            ['fakultas' => 'FH',       'baseline_2025' => 73.94, 'target_2026' => 75.94],
            ['fakultas' => 'FT',       'baseline_2025' => 81.67, 'target_2026' => 81.67],
            ['fakultas' => 'FK',       'baseline_2025' => 96.09, 'target_2026' => 96.09],
            ['fakultas' => 'FP',       'baseline_2025' => 62.62, 'target_2026' => 64.62],
            ['fakultas' => 'FKIP',     'baseline_2025' => 75.42, 'target_2026' => 75.42],
            ['fakultas' => 'FISIP',    'baseline_2025' => 65.52, 'target_2026' => 67.52],
            ['fakultas' => 'FMIPA',    'baseline_2025' => 74.57, 'target_2026' => 76.57],
            ['fakultas' => 'FASILKOM', 'baseline_2025' => 73.86, 'target_2026' => 75.86],
            ['fakultas' => 'FKM',      'baseline_2025' => 71.44, 'target_2026' => 73.44],
        ];
        foreach ($iku2Fakultas as $data) {
            DB::table('target_fakultas')->insert([
                'kode_iku' => 'IKU 2', 'fakultas' => $data['fakultas'],
                'baseline_2025' => $data['baseline_2025'], 'target_2026' => $data['target_2026'],
                'satuan' => '%', 'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 4. IKU 3 - Sumber: PDF Target Mahasiswa Berkegiatan (35% dari S1/D3)
        $iku3Target = [
            ['fakultas' => 'FE',       'target_2026' => 1208],
            ['fakultas' => 'FH',       'target_2026' => 755],
            ['fakultas' => 'FT',       'target_2026' => 1369],
            ['fakultas' => 'FK',       'target_2026' => 760],
            ['fakultas' => 'FP',       'target_2026' => 1642],
            ['fakultas' => 'FKIP',     'target_2026' => 2076],
            ['fakultas' => 'FISIP',    'target_2026' => 1586],
            ['fakultas' => 'FMIPA',    'target_2026' => 953],
            ['fakultas' => 'FASILKOM', 'target_2026' => 1108],
            ['fakultas' => 'FKM',      'target_2026' => 688],
        ];
        foreach ($iku3Target as $data) {
            DB::table('target_fakultas')->insert([
                'kode_iku' => 'IKU 3', 'fakultas' => $data['fakultas'],
                'baseline_2025' => null, 'target_2026' => $data['target_2026'],
                'satuan' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 5. IKU 6 - Sumber: PDF tabel IKU 6 per fakultas (Total publikasi internasional target 2026)
        $iku6Fakultas = [
            ['fakultas' => 'FE',       'target_2026' => 34],
            ['fakultas' => 'FH',       'target_2026' => 14],
            ['fakultas' => 'FT',       'target_2026' => 112],
            ['fakultas' => 'FK',       'target_2026' => 82],
            ['fakultas' => 'FP',       'target_2026' => 92],
            ['fakultas' => 'FKIP',     'target_2026' => 111],
            ['fakultas' => 'FISIP',    'target_2026' => 18],
            ['fakultas' => 'FMIPA',    'target_2026' => 125],
            ['fakultas' => 'FASILKOM', 'target_2026' => 54],
            ['fakultas' => 'FKM',      'target_2026' => 31],
            ['fakultas' => 'SPS',      'target_2026' => 39],
        ];
        foreach ($iku6Fakultas as $data) {
            DB::table('target_fakultas')->insert([
                'kode_iku' => 'IKU 6', 'fakultas' => $data['fakultas'],
                'baseline_2025' => null, 'target_2026' => $data['target_2026'],
                'satuan' => 'Artikel', 'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Seeder berhasil dijalankan! Seluruh data aktual IKU 1 s.d. IKU 11 sudah disinkronisasikan ke tabel.');
    }
}