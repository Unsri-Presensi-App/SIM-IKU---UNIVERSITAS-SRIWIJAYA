<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedTahun = $request->input('tahun', '2026');
        $targets = DB::table('target_iku')->get()->keyBy('kode_iku');

        $chartLabels = [];
        $chartCapaian = [];
        $chartTargets = [];
        $semuaIku = [];
        
        $dimensi = ['lulusan' => 0, 'dosen' => 0, 'kurikulum' => 0];

        $mapping = [
            1 => 'IKU 1', 2 => 'IKU 2', 3 => 'IKU 3', 4 => 'IKU 4', 
            5 => 'IKU 5', 6 => 'IKU 6', 7 => 'IKU 7', 8 => 'IKU 8', 
            9 => 'IKU 9', 10 => 'IKU 10', 11 => 'IKU 11_SAKIP', 12 => 'IKU 12'
        ];

        foreach($mapping as $i => $kode) {
            $chartLabels[] = 'IKU ' . $i;
            $chartTargets[] = 100; 

            $t = $targets->get($kode);
            $nama_iku = $t ? $t->nama_iku : 'Indikator ' . $i;
            
            if ($selectedTahun == '2025') {
                $target_val = $t ? floatval($t->baseline_2025) : 80;
                $realisasi_val = $target_val * 0.85; 
            } else {
                $target_val = $t ? floatval($t->target_2026) : 100;
                $realisasi_val = $t ? floatval($t->baseline_2025) : 0; 
            }

            if ($i == 6) {
                $persentase = $selectedTahun == '2025' ? (500 / 590) * 100 : (590 / 708) * 100;
            } elseif ($i == 10) {
                $persentase = $selectedTahun == '2025' ? (0 / 1) * 100 : (1 / 2) * 100;
            } elseif ($i == 11 || $i == 12) {
                $persentase = $selectedTahun == '2025' ? 70 : 100;
            } else {
                $persentase = $target_val > 0 ? ($realisasi_val / $target_val) * 100 : 0;
            }

            $capaian_final = round($persentase, 1);
            $chartCapaian[] = $capaian_final;

            if ($i <= 3) $dimensi['lulusan'] += ($capaian_final / 3);
            elseif ($i <= 6) $dimensi['dosen'] += ($capaian_final / 3);
            else $dimensi['kurikulum'] += ($capaian_final / 6);

            $semuaIku[] = (object)[
                'kode' => 'IKU ' . $i,
                'nama' => $nama_iku,
                'target' => $target_val,
                'realisasi' => $realisasi_val,
                'capaian_persen' => $capaian_final,
            ];
        }

        $fakultas = ['FE', 'FH', 'FT', 'FK', 'FP', 'FKIP', 'FISIP', 'FMIPA', 'FASILKOM', 'FKM'];
        $dbFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 2')->get()->keyBy('fakultas');
        $radarData = [];
        
        foreach($fakultas as $f) {
            $val = $dbFakultas->get($f);
            if ($val && $val->target_2026 > 0) {
                $pengali = $selectedTahun == '2025' ? 0.8 : 1; 
                $skor = round((($val->baseline_2025 * $pengali) / $val->target_2026) * 100, 1);
            } else {
                $skor = 0;
            }
            $radarData[] = $skor;
        }

        $rata_rata_pt = count($chartCapaian) > 0 ? collect($chartCapaian)->avg() : 0;
        
        $aman = collect($chartCapaian)->filter(fn($v) => $v >= 100)->count();
        $mendekati = collect($chartCapaian)->filter(fn($v) => $v >= 80 && $v < 100)->count();
        $kritis = collect($chartCapaian)->filter(fn($v) => $v < 80)->count();

        $tabelKritis = collect($semuaIku)->filter(fn($v) => $v->capaian_persen < 80)->sortBy('capaian_persen');

        return view('dashboard', compact(
            'chartLabels', 'chartCapaian', 'chartTargets', 
            'fakultas', 'radarData', 'semuaIku',
            'rata_rata_pt', 'aman', 'mendekati', 'kritis', 
            'tabelKritis', 'dimensi', 
            'selectedTahun'
        ));
    }
}