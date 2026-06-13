<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedTahun = $request->input('tahun', '2026');

        // Ambil seluruh target IKU dari DB, di-index per kode_iku.
        $targets = DB::table('target_iku')->get()->keyBy('kode_iku');

        $chartLabels  = [];
        $chartCapaian = [];   // = "Progres Baseline -> Target" (bukan realisasi nyata, lihat catatan)
        $chartTargets = [];   // garis acuan 100%
        $semuaIku     = [];

        // ============================================================
        //  CATATAN PENTING — SUMBER DATA REALISASI
        //  Realisasi IKU yang sesungguhnya belum tersedia karena API
        //  (mahasiswa aktif/keluar & tracer study) masih dikembangkan.
        //  Sementara ini "progres" dihitung dari posisi BASELINE 2025
        //  terhadap TARGET, sehingga angka di dashboard DIBERI LABEL
        //  "Progres Baseline -> Target", BUKAN capaian realisasi.
        //  Saat API live: ganti $realisasiNyata di bawah dgn data API.
        // ============================================================
        $realisasiTersedia = false; // set true bila API realisasi sudah masuk

        // Hanya 11 IKU sesuai Kontrak Kinerja Rektor UNSRI (PDF). Tidak ada IKU 12.
        // Untuk IKU 11 dipakai sub-indikator SAKIP sebagai wakil kuantitatif.
        $mapping = [
            1  => 'IKU 1',
            2  => 'IKU 2',
            3  => 'IKU 3',
            4  => 'IKU 4',
            5  => 'IKU 5',
            6  => 'IKU 6',
            7  => 'IKU 7',
            8  => 'IKU 8',
            9  => 'IKU 9',
            10 => 'IKU 10',
            11 => 'IKU 11_SAKIP',
        ];

        // Nama tampilan ringkas bila DB tidak punya baris (fallback).
        $namaFallback = [
            1  => 'Angka Efisiensi Edukasi (AEE PT)',
            2  => 'Lulusan Bekerja/Lanjut/Wirausaha',
            3  => 'Mahasiswa Berprestasi di Luar Prodi',
            4  => 'Dosen Rekognisi Internasional',
            5  => 'Luaran Kerjasama Industri/Lembaga',
            6  => 'Publikasi Internasional (Scopus/WoS)',
            7  => 'Keterlibatan PT dalam SDGs',
            8  => 'SDM Terlibat Penyusunan Kebijakan',
            9  => 'Pendapatan Non UKT',
            10 => 'Usulan Zona Integritas',
            11 => 'Predikat SAKIP',
        ];

        // Dimensi mengikuti SASARAN STRATEGIS pada PDF Kepmen:
        //   Talenta      = IKU 1-3
        //   Inovasi      = IKU 4-6
        //   Tata Kelola  = IKU 7-11
        $dimSum   = ['talenta' => 0.0, 'inovasi' => 0.0, 'tata_kelola' => 0.0];
        $dimCount = ['talenta' => 0,   'inovasi' => 0,   'tata_kelola' => 0];

        foreach ($mapping as $i => $kode) {
            $chartLabels[]  = 'IKU ' . $i;
            $chartTargets[] = 100; // acuan target = 100%

            $t        = $targets->get($kode);
            $nama_iku = $t->nama_iku ?? $namaFallback[$i];
            $satuan   = $t->satuan ?? '%';

            // Pilih kolom sesuai tahun yang dipilih.
            if ($selectedTahun == '2025') {
                // Untuk 2025 belum ada pembanding; tampilkan baseline sebagai posisi awal.
                $baseVal   = $t ? floatval($t->baseline_2025) : 0;
                $targetVal = $t ? floatval($t->baseline_2025) : 0; // acuan = baseline itu sendiri
            } else {
                $baseVal   = $t ? floatval($t->baseline_2025) : 0; // posisi awal (proxy realisasi)
                $targetVal = $t ? floatval($t->target_2026) : 0;   // target tahun berjalan
            }

            // TODO (API): bila $realisasiTersedia, ganti $realisasiVal dgn nilai realisasi nyata dari API.
            $realisasiVal = $baseVal;

            // Progres = realisasi (sementara=baseline) terhadap target, di-cap 100% utk visual.
            if ($selectedTahun == '2025') {
                // Pada 2025 hanya tampilkan baseline; progres tidak relevan -> 100% (posisi awal).
                $progres = $targetVal > 0 ? min(($realisasiVal / $targetVal) * 100, 100) : 0;
            } else {
                $progres = $targetVal > 0 ? min(($realisasiVal / $targetVal) * 100, 100) : 0;
            }

            // IKU 11 (SAKIP) bersifat predikat (A -> AA). Tidak ada angka baseline/target di DB,
            // jadi diberi nilai indikatif berbasis predikat agar tidak kosong/menyesatkan.
            if ($kode === 'IKU 11_SAKIP') {
                // Baseline predikat A (~85), target AA (~95). Progres = 85/95.
                $baseVal      = 85;   // A
                $targetVal    = 95;   // AA
                $realisasiVal = 85;
                $satuan       = 'Nilai';
                $progres      = round(($baseVal / $targetVal) * 100, 1);
            }

            $progres_final = round($progres, 1);
            $chartCapaian[] = $progres_final;

            // Akumulasi dimensi (rata-rata per kelompok, dihitung di akhir).
            if     ($i <= 3) { $dimSum['talenta']     += $progres_final; $dimCount['talenta']++; }
            elseif ($i <= 6) { $dimSum['inovasi']     += $progres_final; $dimCount['inovasi']++; }
            else             { $dimSum['tata_kelola'] += $progres_final; $dimCount['tata_kelola']++; }

            $semuaIku[] = (object)[
                'kode'           => 'IKU ' . $i,
                'nama'           => $nama_iku,
                'satuan'         => $satuan,
                'baseline'       => $baseVal,
                'target'         => $targetVal,
                'realisasi'      => $realisasiVal,
                'capaian_persen' => $progres_final,
            ];
        }

        // Rata-rata per dimensi (hindari bagi nol).
        $dimensi = [
            'talenta'     => $dimCount['talenta']     ? $dimSum['talenta']     / $dimCount['talenta']     : 0,
            'inovasi'     => $dimCount['inovasi']     ? $dimSum['inovasi']     / $dimCount['inovasi']     : 0,
            'tata_kelola' => $dimCount['tata_kelola'] ? $dimSum['tata_kelola'] / $dimCount['tata_kelola'] : 0,
        ];

        // ── Data per fakultas (radar) — dari target IKU 2 yang sudah benar di DB ──
        $fakultas   = ['FE', 'FH', 'FT', 'FK', 'FP', 'FKIP', 'FISIP', 'FMIPA', 'FASILKOM', 'FKM'];
        $dbFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 2')->get()->keyBy('fakultas');
        $radarData  = [];

        foreach ($fakultas as $f) {
            $val = $dbFakultas->get($f);
            if ($val && $val->target_2026 > 0) {
                // Progres baseline fakultas thd targetnya (dicap 100).
                $skor = round(min(($val->baseline_2025 / $val->target_2026) * 100, 100), 1);
            } else {
                $skor = 0;
            }
            $radarData[] = $skor;
        }

        // ── Ringkasan status ──
        $rata_rata_pt = count($chartCapaian) > 0 ? collect($chartCapaian)->avg() : 0;

        $aman      = collect($chartCapaian)->filter(fn($v) => $v >= 100)->count();
        $mendekati = collect($chartCapaian)->filter(fn($v) => $v >= 80 && $v < 100)->count();
        $kritis    = collect($chartCapaian)->filter(fn($v) => $v < 80)->count();

        $tabelKritis = collect($semuaIku)
            ->filter(fn($v) => $v->capaian_persen < 80)
            ->sortBy('capaian_persen')
            ->values();

        return view('dashboard', compact(
            'chartLabels', 'chartCapaian', 'chartTargets',
            'fakultas', 'radarData', 'semuaIku',
            'rata_rata_pt', 'aman', 'mendekati', 'kritis',
            'tabelKritis', 'dimensi',
            'selectedTahun', 'realisasiTersedia'
        ));
    }
}