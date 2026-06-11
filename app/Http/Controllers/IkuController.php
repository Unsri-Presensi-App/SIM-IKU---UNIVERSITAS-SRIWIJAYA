<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IkuController extends Controller
{
    public function ikuSatu(Request $request)
    {
        // 1. Tangkap parameter dari UI (Dropdown)
        $selectedFakultas = $request->input('fakultas', 'Universitas Sriwijaya');
        $selectedTahun = $request->input('tahun', '2026');

        // 2. Logic Tombol Export Excel
        if ($request->has('export') && $request->export == 'excel') {
            return redirect()->back()->with('info', 'File Excel untuk ' . $selectedFakultas . ' sedang diproses (Fitur ini butuh library Laravel Excel).');
        }

        // 3. Daftar Lengkap Fakultas Sesuai Data
        $listFakultas = ['FE', 'FH', 'FT', 'FK', 'FP', 'FKIP', 'FISIP', 'FMIPA', 'FASILKOM', 'FKM', 'SPS'];

        // 4. Mapping Data Mentah (Mhs Masuk & Lulus) karena DB Seeder hanya simpan Persentase Target
        $raw = [
            'Universitas Sriwijaya' => ['D3'=>[1566,269], 'S1'=>[33134,5004], 'S2'=>[2615,536], 'S3'=>[837,97]],
            'FE' => ['D3'=>[733,126], 'S1'=>[2718,479], 'S2'=>[290,58], 'S3'=>[129,2]],
            'FH' => ['S1'=>[2158,350], 'S2'=>[413,83], 'S3'=>[110,6]],
            'FT' => ['S1'=>[3912,360], 'S2'=>[179,36], 'S3'=>[203,22]],
            'FK' => ['S1'=>[2171,436], 'S2'=>[777,88], 'S3'=>[121,26]],
            'FP' => ['S1'=>[4691,679], 'S2'=>[92,19], 'S3'=>[33,7]],
            'FKIP' => ['S1'=>[5932,923], 'S2'=>[357,134], 'S3'=>[66,4]],
            'FISIP' => ['S1'=>[4531,605], 'S2'=>[182,47], 'S3'=>[106,21]],
            'FMIPA' => ['S1'=>[2724,526], 'S2'=>[76,19], 'S3'=>[34,9]],
            'FASILKOM' => ['D3'=>[833,143], 'S1'=>[2332,373], 'S2'=>[66,14], 'S3'=>[16,0]],
            'FKM' => ['S1'=>[1965,275], 'S2'=>[136,28], 'S3'=>[19,0]],
            'SPS' => ['S2'=>[47,11]],
        ];

 // 5. Ambil Target Utama Universitas dari Seeder
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 1')->first();
        $targetAeePT = $targetIku->target_2026 ?? 43.13;

        $dataTabel = [];
        // INI PEMBAGI RUMUS AEE (Sesuai PDF Hal 7)
        $aee_ideal_map = ['D3' => 33.00, 'S1' => 25.00, 'S2' => 50.00, 'S3' => 33.00];
        
        // INI TARGET KINERJA REKTOR (Sesuai PDF Hal 2 & 4)
        $target_pk_map = ['D3' => 51.50, 'S1' => 50.00, 'S2' => 40.00, 'S3' => 31.00];
        
        $nama_jenjang = ['D3' => 'Diploma Tiga', 'S1' => 'Sarjana', 'S2' => 'Magister', 'S3' => 'Doktor'];

        // 6. Tarik Data Dinamis Berdasarkan Pilihan Dropdown
        $fakData = $raw[$selectedFakultas] ?? [];

        foreach ($fakData as $jenjang => $val) {
            $mhs = $val[0];
            $lulus = $val[1];
            $realisasi = $mhs > 0 ? ($lulus / $mhs) * 100 : 0;
            $ideal = $aee_ideal_map[$jenjang];
            $pencapaian = $ideal > 0 ? ($realisasi / $ideal) * 100 : 0;
            
            // Masukkan variabel target PK ke dalam object
            $target_pk = $target_pk_map[$jenjang];

            $dataTabel[] = (object)[
                'jenjang' => $nama_jenjang[$jenjang],
                'total_mahasiswa' => $mhs,
                'lulus_tepat_waktu' => $lulus,
                'aee_realisasi' => $realisasi,
                'aee_ideal' => $ideal,
                'tingkat_pencapaian' => $pencapaian,
                'target_pk' => $target_pk
            ];
        }

        // 7. Hitung Rata-Rata Capaian Keseluruhan
        $aee_pt = count($dataTabel) > 0 ? collect($dataTabel)->avg('tingkat_pencapaian') : 0;

        return view('iku.iku-satu', compact('dataTabel', 'aee_pt', 'targetAeePT', 'selectedFakultas', 'selectedTahun', 'listFakultas'));
    }

    // IKU 2 - Lulusan Bekerja
    public function ikuDua()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 2')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 2')->get();
        
        return view('iku.iku-dua', [
            'target' => $targetIku->target_2026 ?? 73,
            'baseline' => $targetIku->baseline_2025 ?? 71,
            'satuan' => $targetIku->satuan ?? '%',
            'fakultas' => $targetFakultas,
        ]);
    }

    // IKU 3 - Mahasiswa Berprestasi
    public function ikuTiga()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 3')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 3')->get();
        
        return view('iku.iku-tiga', [
            'target' => $targetIku->target_2026 ?? 30,
            'baseline' => $targetIku->baseline_2025 ?? 14.9,
            'satuan' => $targetIku->satuan ?? '%',
            'target_jumlah' => $targetFakultas,
        ]);
    }

    // IKU 4 - Rekognisi Dosen
    public function ikuEmpat()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 4')->first();
        $targetS3 = DB::table('target_iku')->where('kode_iku', 'IKU 4_S3')->first();
        
        return view('iku.iku-empat', [
            'target' => $targetIku->target_2026 ?? 44.6,
            'baseline' => $targetIku->baseline_2025 ?? 37.33,
            'target_s3' => $targetS3->target_2026 ?? 39.6,
            'baseline_s3' => $targetS3->baseline_2025 ?? 29.75,
            'satuan' => $targetIku->satuan ?? '%',
        ]);
    }

    // IKU 5 - Kerjasama Industri
    public function ikuLima()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 5')->first();
        
        return view('iku.iku-lima', [
            'target' => $targetIku->target_2026 ?? 5,
            'baseline' => $targetIku->baseline_2025 ?? 0.58,
            'satuan' => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 6 - Publikasi Internasional
    public function ikuEnam()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 6')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 6')->get();
        
        return view('iku.iku-enam', [
            'target' => $targetIku->target_2026 ?? 708,
            'baseline' => $targetIku->baseline_2025 ?? 590,
            'satuan' => $targetIku->satuan ?? 'Artikel',
            'fakultas' => $targetFakultas,
        ]);
    }

    // IKU 7 - SDGs
    public function ikuTujuh()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 7')->first();
        
        return view('iku.iku-tujuh', [
            'target' => $targetIku->target_2026 ?? 55,
            'baseline' => $targetIku->baseline_2025 ?? 36,
            'satuan' => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 8 - SDM Kebijakan
    public function ikuDelapan()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 8')->first();
        
        return view('iku.iku-delapan', [
            'target' => $targetIku->target_2026 ?? 25,
            'baseline' => $targetIku->baseline_2025 ?? 5,
            'satuan' => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 9 - Pendapatan Non UKT
    public function ikuSembilan()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 9')->first();
        
        return view('iku.iku-sembilan', [
            'target' => $targetIku->target_2026 ?? 15,
            'baseline' => $targetIku->baseline_2025 ?? 13.3,
            'satuan' => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 10 - Zona Integritas
    public function ikuSepuluh()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 10')->first();
        
        return view('iku.iku-sepuluh', [
            'target' => $targetIku->target_2026 ?? 2,
            'baseline' => $targetIku->baseline_2025 ?? 1,
            'satuan' => $targetIku->satuan ?? 'Unit Kerja',
        ]);
    }

    // IKU 11 - Opini WTP & SAKIP
    public function ikuSebelas()
    {
        $wtp = DB::table('target_iku')->where('kode_iku', 'IKU 11')->first();
        $sakip = DB::table('target_iku')->where('kode_iku', 'IKU 11_SAKIP')->first();
        
        return view('iku.iku-sebelas', [
            'opini_target' => $wtp->keterangan ?? 'WTP',
            'sakip_target' => $sakip->keterangan ?? 'AA',
        ]);
    }
}