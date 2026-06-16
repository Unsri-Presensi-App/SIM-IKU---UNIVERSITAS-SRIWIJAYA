<?php

namespace Database\Seeders;

use App\Models\InputIku;
use App\Models\RiwayatValidasi;
use App\Models\SinkronisasiIku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * InputIkuSeeder
 * ------------------------------------------------------------------
 * Mengisi contoh entri data IKU (draft/diajukan/valid) dan log
 * sinkronisasi untuk IKU otomatis, agar tampilan mockup ada isinya.
 * TODO: hapus/ganti dengan data riil saat operasional.
 * ------------------------------------------------------------------
 */
class InputIkuSeeder extends Seeder
{
    public function run(): void
    {
        // Reset agar idempoten.
        DB::table('riwayat_validasi')->delete();
        DB::table('eviden_iku')->delete();
        DB::table('input_iku')->delete();
        DB::table('sinkronisasi_iku')->delete();

        $operatorFt = DB::table('users')->where('email', 'operator.ft@unsri.ac.id')->value('id');
        $validator  = DB::table('users')->where('email', 'validator@unsri.ac.id')->value('id');

        // Contoh entri per IKU (judul + data + status).
        $contoh = [
            ['4',  'Rekognisi Prof. Andi - Keynote ICML 2026', ['nidn' => '0012128501', 'nama' => 'Prof. Andi', 'jenis' => 'Keynote Speaker', 'institusi' => 'ICML, Amerika Serikat'], 'valid'],
            ['4',  'Rekognisi Dr. Sari - Reviewer Q1',           ['nidn' => '0021058702', 'nama' => 'Dr. Sari', 'jenis' => 'Reviewer Jurnal Q1', 'institusi' => 'Elsevier'], 'diajukan'],
            ['5',  'Hilirisasi Pupuk Organik - PT Pusri',        ['nomor_mou' => 'MoU/2026/014', 'mitra' => 'PT Pupuk Sriwidjaja', 'jenis' => 'Produk Komersial', 'status' => 'Telah Dimanfaatkan'], 'valid'],
            ['7',  'Program Desa Binaan SDG 1 - Ogan Ilir',      ['nama_program' => 'Desa Binaan Pengentasan Kemiskinan', 'jenis' => 'Pengabdian', 'sasaran' => 'SDG 1', 'penerima' => '120 KK'], 'diajukan'],
            ['8',  'Naskah Akademik RUU Pendidikan - Prof. Budi',['nama' => 'Prof. Budi', 'jenis' => 'Kebijakan Nasional', 'instansi' => 'Kemdiktisaintek', 'bentuk' => 'Tim Penyusun'], 'draft'],
            ['10', 'Usulan WBK - Fakultas Teknik',               ['unit' => 'Fakultas Teknik', 'jenis' => 'WBK', 'tanggal' => '2026-03-10', 'nomor' => '421/UN9.FT/2026'], 'diajukan'],
            ['11a','Opini WTP TA 2025 - BPK RI',                 ['tahun' => '2025', 'auditor' => 'BPK RI', 'opini' => 'WTP', 'nomor' => 'LHP/2026/008'], 'valid'],
            ['12', 'Renstra UNSRI 2025-2029',                    ['nama' => 'Renstra UNSRI 2025-2029', 'jenis' => 'Renstra', 'nomor' => 'SK/Rektor/2026/051', 'periode' => '2025-2029'], 'draft'],
        ];

        foreach ($contoh as [$kode, $judul, $data, $status]) {
            $entri = InputIku::create([
                'kode_iku'      => $kode,
                'fakultas'      => 'FT',
                'tahun'         => 2026,
                'semester'      => 1,
                'triwulan'      => 1,
                'judul_subjek'  => $judul,
                'data_json'     => $data,
                'status'        => $status,
                'catatan'       => null,
                'created_by'    => $operatorFt,
                'validated_by'  => $status === 'valid' ? $validator : null,
                'diajukan_at'   => in_array($status, ['diajukan', 'valid']) ? now()->subDays(3) : null,
                'divalidasi_at' => $status === 'valid' ? now()->subDays(1) : null,
            ]);

            // Riwayat dasar.
            if (in_array($status, ['diajukan', 'valid'])) {
                RiwayatValidasi::create(['input_iku_id' => $entri->id, 'aksi' => 'ajukan', 'dilakukan_oleh' => $operatorFt, 'created_at' => now()->subDays(3), 'updated_at' => now()->subDays(3)]);
            }
            if ($status === 'valid') {
                RiwayatValidasi::create(['input_iku_id' => $entri->id, 'aksi' => 'validasi', 'catatan' => 'Bukti lengkap & sesuai.', 'dilakukan_oleh' => $validator, 'created_at' => now()->subDays(1), 'updated_at' => now()->subDays(1)]);
            }
        }

        // Log sinkronisasi untuk IKU otomatis (1, 6, 9).
        foreach (['1' => 'API Data Lake / SIM Akademik', '6' => 'SINTA / Scopus / WoS', '9' => 'SIM Keuangan'] as $kode => $sumber) {
            for ($d = 0; $d < 3; $d++) {
                SinkronisasiIku::create([
                    'kode_iku'     => $kode,
                    'status'       => 'berhasil',
                    'sumber_api'   => $sumber,
                    'pesan'        => 'Sinkronisasi terjadwal berhasil.',
                    'disinkron_at' => now()->subDays($d)->setTime(2, 0),
                ]);
            }
        }

        $this->command->info('Contoh entri IKU & log sinkronisasi dibuat.');
    }
}