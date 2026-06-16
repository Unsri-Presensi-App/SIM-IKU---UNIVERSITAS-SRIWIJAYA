<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IkuSatuExport;
use App\Services\MahasiswaService;
use App\Models\InputIku;

class IkuController extends Controller
{
    /**
     * Service data mahasiswa (placeholder API).
     * Diinjeksikan agar mudah di-mock saat pengujian & di-swap saat API live.
     */
    public function __construct(
        private MahasiswaService $mahasiswaService
    ) {
    }

    public function ikuSatu(Request $request)
    {
        // 1. Tangkap parameter dari UI (Dropdown)
        $selectedFakultas = $request->input('fakultas', 'Universitas Sriwijaya');
        $selectedTahun    = $request->input('tahun', '2026');

        // 2. Logic Tombol Export Excel
        if ($request->has('export') && $request->export == 'excel') {
            return redirect()->back()->with('info', 'File Excel untuk ' . $selectedFakultas . ' sedang diproses (Fitur ini butuh library Laravel Excel).');
        }

        // 3. Daftar Lengkap Fakultas Sesuai Data
        $listFakultas = ['FE', 'FH', 'FT', 'FK', 'FP', 'FKIP', 'FISIP', 'FMIPA', 'FASILKOM', 'FKM', 'SPS'];

        // 4. Jenjang yang dimiliki tiap fakultas. Angka realisasi TIDAK di-hardcode di sini;
        //    ditarik via getJumlahMahasiswaAktif/Keluar (placeholder API).
        $jenjangPerFakultas = [
            'Universitas Sriwijaya' => ['D3', 'S1', 'S2', 'S3'],
            'FE'       => ['D3', 'S1', 'S2', 'S3'],
            'FH'       => ['S1', 'S2', 'S3'],
            'FT'       => ['S1', 'S2', 'S3'],
            'FK'       => ['S1', 'S2', 'S3'],
            'FP'       => ['S1', 'S2', 'S3'],
            'FKIP'     => ['S1', 'S2', 'S3'],
            'FISIP'    => ['S1', 'S2', 'S3'],
            'FMIPA'    => ['S1', 'S2', 'S3'],
            'FASILKOM' => ['D3', 'S1', 'S2', 'S3'],
            'FKM'      => ['S1', 'S2', 'S3'],
            'SPS'      => ['S2'],
        ];

        // 5. Ambil Target Utama Universitas (AEE PT).
        //    a) AEE PT headline PK Rektor (PDF hal.2): baseline 42,53% -> target 43,13%.
        //       Ini skala "AEE PT langsung", ditampilkan sbg info resmi di sidebar.
        $targetIku     = DB::table('target_iku')->where('kode_iku', 'IKU 1')->first();
        $targetAeePT   = $targetIku->target_2026   ?? 43.13;
        $baselineAeePT = $targetIku->baseline_2025 ?? 42.53;

        //    b) Target Rekap Tingkat Pencapaian (PDF hal.5/15) = 47,11% — pembanding SETARA
        //       untuk rata-rata tingkat pencapaian yang dihitung di bawah (hindari campur skala).
        $rekapPT             = DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_PT')->first();
        $targetPencapaianPT  = $rekapPT->target_2026   ?? 47.11;
        $baselinePencapaianPT = $rekapPT->baseline_2025 ?? 36.95;

        // PEMBAGI RUMUS AEE / "AEE Ideal" (PDF Kepmen hal.4): D3=33, S1=25, S2=50, S3=33
        $aee_ideal_map = ['D3' => 33.00, 'S1' => 25.00, 'S2' => 50.00, 'S3' => 33.00];

        // TARGET TINGKAT PENCAPAIAN AEE per jenjang (PDF hal.5 - tabel PJ).
        // Ini pembanding yang setara dengan kolom "tingkat_pencapaian" tiap baris.
        // Sumber resmi (OCR PDF hal.5): D3=52,05% S1=60,41% S2=41,02% S3=35,05%.
        // Diambil dari seeder (kode_iku 'IKU 1_PENCAPAIAN_*') agar tidak ada hardcode,
        // dengan fallback ke angka PDF bila baris seeder belum tersedia.
        $target_pencapaian_map = [
            'D3' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_D3')->first())->target_2026 ?? 52.05,
            'S1' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_S1')->first())->target_2026 ?? 60.41,
            'S2' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_S2')->first())->target_2026 ?? 41.02,
            'S3' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_S3')->first())->target_2026 ?? 35.05,
        ];

        $nama_jenjang = ['D3' => 'Diploma Tiga', 'S1' => 'Sarjana', 'S2' => 'Magister', 'S3' => 'Doktor'];

        // 6. Susun data tabel per jenjang dari API (mock) — siap menerima data asli nanti.
        $jenjangList      = $jenjangPerFakultas[$selectedFakultas] ?? [];
        $dataTabel        = [];
        $dataBelumLengkap = false; // flag: ada jenjang yang datanya belum tersedia dari API

        foreach ($jenjangList as $jenjang) {
            // Kunci prodi untuk API. Saat API riil siap, ganti dgn kode prodi sebenarnya.
            $prodiKey = $selectedFakultas . '|' . $jenjang;

            // === Panggil API (placeholder via MahasiswaService) ===
            $aktif  = $this->mahasiswaService->getJumlahMahasiswaAktif($prodiKey);
            $keluar = $this->mahasiswaService->getJumlahMahasiswaKeluar($prodiKey);

            // Bila API belum mengembalikan data (aktif <= 0), tandai & lewati baris ini dengan aman.
            if ($aktif <= 0) {
                $dataBelumLengkap = true;
                continue;
            }

            // Total mahasiswa keluar (pindah + DO + cuti melebihi ketentuan) dari struktur API.
            $totalKeluar = collect($keluar)->sum('jumlah');

            // Lulus tepat waktu: sementara dari mock; nanti dari endpoint terkait.
            $lulus = $this->mahasiswaService->getJumlahLulusTepatWaktu($prodiKey);

            // Cohort = aktif dikurangi yang keluar (PDF: pindah/DO/cuti tidak dihitung).
            $cohort = max(0, $aktif - $totalKeluar);

            // AEE realisasi = lulus tepat waktu / cohort * 100  (PDF Formula a)
            $realisasi  = $cohort > 0 ? ($lulus / $cohort) * 100 : 0;
            $ideal      = $aee_ideal_map[$jenjang] ?? 0;
            // Tingkat Pencapaian AEE = realisasi / ideal * 100  (PDF Formula b)
            $pencapaian = $ideal > 0 ? ($realisasi / $ideal) * 100 : 0;
            // Target Tingkat Pencapaian resmi per jenjang (PDF hal.5) sebagai pembanding setara.
            $target_pk  = $target_pencapaian_map[$jenjang] ?? 0;

            $dataTabel[] = (object)[
                'jenjang'           => $nama_jenjang[$jenjang] ?? $jenjang,
                'total_mahasiswa'   => $cohort,
                'lulus_tepat_waktu' => $lulus,
                'aee_realisasi'     => $realisasi,
                'aee_ideal'         => $ideal,
                'tingkat_pencapaian'=> $pencapaian,
                'target_pk'         => $target_pk,
            ];
        }

        // 7. AEE PT = rata-rata tingkat pencapaian seluruh jenjang  (PDF Formula c)
        $aee_pt = count($dataTabel) > 0 ? collect($dataTabel)->avg('tingkat_pencapaian') : 0;

        // 8. % capaian terhadap target. Pembanding SETARA: rata-rata tingkat pencapaian
        //    dibandingkan target rekap pencapaian (47,11%), bukan headline PK (43,13%),
        //    agar tidak mencampur dua skala berbeda (lihat TEMUAN dokumentasi).
        $capaian_thd_target = $targetPencapaianPT > 0 ? ($aee_pt / $targetPencapaianPT) * 100 : 0;

        return view('iku.iku-satu', compact(
            'dataTabel',
            'aee_pt',
            'targetAeePT',
            'baselineAeePT',
            'targetPencapaianPT',
            'baselinePencapaianPT',
            'capaian_thd_target',
            'selectedFakultas',
            'selectedTahun',
            'listFakultas',
            'dataBelumLengkap'
        ));
    }

    public function exportIkuSatuExcel()
    {
        // Resolve via container agar dependensi MahasiswaService terinjeksi otomatis.
        return Excel::download(app(IkuSatuExport::class), 'Laporan_IKU_1_AEE.xlsx');
    }

    // IKU 2 - Lulusan Bekerja
    public function ikuDua()
    {
        $targetIku      = DB::table('target_iku')->where('kode_iku', 'IKU 2')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 2')->get();
        $realisasiTersedia = false;

        $iku_meta    = config('iku.2');
        $entri       = InputIku::kode('2')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('2')->where('status', 'valid')->count();

        return view('iku.iku-dua', [
            'target'            => $targetIku->target_2026 ?? 75,
            'baseline'          => $targetIku->baseline_2025 ?? 73.6,
            'satuan'            => $targetIku->satuan ?? '%',
            'fakultas'          => $targetFakultas,
            'realisasiTersedia' => $realisasiTersedia,
            'iku_meta'          => $iku_meta,
            'entri'             => $entri,
            'jumlahValid'       => $jumlahValid,
        ]);
    }

    // IKU 3 - Mahasiswa Berprestasi
    public function ikuTiga()
    {
        $targetIku      = DB::table('target_iku')->where('kode_iku', 'IKU 3')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 3')->orderBy('fakultas')->get();

        $baseline = $targetIku->baseline_2025 ?? 14.90;
        $target   = $targetIku->target_2026   ?? 35.00;

        $mahasiswa_s1_map = [
            'FE'=>2718,'FH'=>2158,'FT'=>3912,'FK'=>2171,'FP'=>4691,
            'FKIP'=>5932,'FISIP'=>4531,'FMIPA'=>2724,'FASILKOM'=>2332,'FKM'=>1965,
        ];
        $mahasiswa_d3_map = ['FE'=>733,'FASILKOM'=>833];

        $rows_fakultas = [];
        $total_s1 = 0; $total_d3 = 0; $total_target = 0;
        foreach ($targetFakultas as $fak) {
            $s1 = $mahasiswa_s1_map[$fak->fakultas] ?? 0;
            $d3 = $mahasiswa_d3_map[$fak->fakultas] ?? 0;
            $total_s1 += $s1; $total_d3 += $d3;
            $total_target += (int)$fak->target_2026;
            $rows_fakultas[] = [
                'fak'    => $fak->fakultas,
                's1'     => $s1,
                'd3'     => $d3,
                'target' => (int)$fak->target_2026,
            ];
        }

        $iku_meta    = config('iku.3');
        $entri       = InputIku::kode('3')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('3')->where('status', 'valid')->count();

        return view('iku.iku-tiga', compact(
            'target', 'baseline',
            'rows_fakultas', 'total_s1', 'total_d3', 'total_target',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 4 - Rekognisi Dosen
    public function ikuEmpat()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 4')->first();
        $targetS3  = DB::table('target_iku')->where('kode_iku', 'IKU 4_S3')->first();

        $baseline_rekognisi = $targetIku->baseline_2025 ?? 37.33;
        $target_rekognisi   = $targetIku->target_2026   ?? 45.00;
        $baseline_s3        = $targetS3->baseline_2025  ?? 29.75;
        $target_s3          = $targetS3->target_2026    ?? 39.60;

        $prog_rekognisi  = $target_rekognisi > 0 ? round($baseline_rekognisi / $target_rekognisi * 100, 1) : 0;
        $prog_s3         = $target_s3 > 0        ? round($baseline_s3 / $target_s3 * 100, 1) : 0;
        $delta_rekognisi = round($target_rekognisi - $baseline_rekognisi, 2);
        $delta_s3        = round($target_s3 - $baseline_s3, 2);

        $iku_meta    = config('iku.4');
        $entri       = InputIku::kode('4')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('4')->where('status', 'valid')->count();

        return view('iku.iku-empat', compact(
            'baseline_rekognisi', 'target_rekognisi',
            'baseline_s3', 'target_s3',
            'prog_rekognisi', 'prog_s3',
            'delta_rekognisi', 'delta_s3',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 5 - Kerjasama Industri
    public function ikuLima()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 5')->first();

        $baseline      = $targetIku->baseline_2025 ?? 0.58;
        $target        = $targetIku->target_2026   ?? 5.00;
        $prog          = $target > 0 ? round($baseline / $target * 100, 1) : 0;
        $target_luaran = 87;

        $iku_meta    = config('iku.5');
        $entri       = InputIku::kode('5')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('5')->where('status', 'valid')->count();

        return view('iku.iku-lima', compact(
            'target', 'baseline', 'prog', 'target_luaran',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 6 - Publikasi Internasional
    public function ikuEnam()
    {
        $targetIku      = DB::table('target_iku')->where('kode_iku', 'IKU 6')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 6')->orderBy('fakultas')->get();

        $total_target   = $targetIku->target_2026   ?? 708;
        $total_baseline = $targetIku->baseline_2025  ?? 590;

        $sub_indikator = [
            'top_tier_baseline' => 8.0,   'top_tier_target' => 8.7,
            'q1_baseline'       => 31.5,  'q1_target'       => 32.0,
            'kolab_baseline'    => 23.6,  'kolab_target'    => 25.1,
        ];

        $rows_publikasi = [
            ['f'=>'FE',      'tb'=>33, 'tt'=>34, 'topb'=>0,  'topt'=>2,  'q1b'=>5,  'q1t'=>6,  'kb'=>0, 'kt'=>9],
            ['f'=>'FH',      'tb'=>13, 'tt'=>14, 'topb'=>0,  'topt'=>2,  'q1b'=>3,  'q1t'=>4,  'kb'=>0, 'kt'=>4],
            ['f'=>'FT',      'tb'=>109,'tt'=>112,'topb'=>11, 'topt'=>22, 'q1b'=>32, 'q1t'=>34, 'kb'=>0, 'kt'=>27],
            ['f'=>'FK',      'tb'=>80, 'tt'=>82, 'topb'=>1,  'topt'=>3,  'q1b'=>18, 'q1t'=>19, 'kb'=>0, 'kt'=>20],
            ['f'=>'FP',      'tb'=>89, 'tt'=>92, 'topb'=>6,  'topt'=>12, 'q1b'=>18, 'q1t'=>19, 'kb'=>0, 'kt'=>21],
            ['f'=>'FKIP',    'tb'=>108,'tt'=>111,'topb'=>5,  'topt'=>10, 'q1b'=>68, 'q1t'=>71, 'kb'=>1, 'kt'=>27],
            ['f'=>'FISIP',   'tb'=>17, 'tt'=>18, 'topb'=>1,  'topt'=>3,  'q1b'=>7,  'q1t'=>8,  'kb'=>0, 'kt'=>5],
            ['f'=>'FMIPA',   'tb'=>122,'tt'=>125,'topb'=>3,  'topt'=>6,  'q1b'=>31, 'q1t'=>33, 'kb'=>0, 'kt'=>30],
            ['f'=>'FASILKOM','tb'=>52, 'tt'=>54, 'topb'=>4,  'topt'=>8,  'q1b'=>15, 'q1t'=>16, 'kb'=>0, 'kt'=>13],
            ['f'=>'FKM',     'tb'=>30, 'tt'=>31, 'topb'=>0,  'topt'=>2,  'q1b'=>8,  'q1t'=>9,  'kb'=>0, 'kt'=>8],
            ['f'=>'SPS',     'tb'=>38, 'tt'=>39, 'topb'=>1,  'topt'=>3,  'q1b'=>11, 'q1t'=>12, 'kb'=>0, 'kt'=>10],
        ];

        $iku_meta    = config('iku.6');
        $entri       = InputIku::kode('6')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('6')->where('status', 'valid')->count();

        return view('iku.iku-enam', compact(
            'total_target', 'total_baseline',
            'sub_indikator', 'rows_publikasi',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 7 - SDGs
    public function ikuTujuh()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 7')->first();

        $baseline = $targetIku->baseline_2025 ?? 36;
        $target   = $targetIku->target_2026   ?? 55;
        $prog     = $target > 0 ? round($baseline / $target * 100, 1) : 0;
        $gap      = round($target - $baseline, 1);

        $iku_meta    = config('iku.7');
        $entri       = InputIku::kode('7')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('7')->where('status', 'valid')->count();

        return view('iku.iku-tujuh', compact(
            'target', 'baseline', 'prog', 'gap',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 8 - SDM Kebijakan
    public function ikuDelapan()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 8')->first();

        $baseline     = $targetIku->baseline_2025 ?? 5;
        $target       = $targetIku->target_2026   ?? 25;
        $prog         = $target > 0 ? round($baseline / $target * 100, 1) : 0;
        $gap          = round($target - $baseline, 1);
        $target_dosen = 436;

        $iku_meta    = config('iku.8');
        $entri       = InputIku::kode('8')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('8')->where('status', 'valid')->count();

        return view('iku.iku-delapan', compact(
            'target', 'baseline', 'prog', 'gap', 'target_dosen',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 9 - Pendapatan Non UKT
    public function ikuSembilan()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 9')->first();

        $baseline = $targetIku->baseline_2025 ?? 13.3;
        $target   = $targetIku->target_2026   ?? 15.0;
        $prog     = $target > 0 ? round($baseline / $target * 100, 1) : 0;
        $gap      = round($target - $baseline, 1);

        $sub_rows = [
            ['label'=>'Pendapatan Non-UKT / Total Pendapatan', 'baseline'=>'13,3%', 'target'=>'15%',    'prog'=>round(13.3/15*100,1),    'status'=>'amber'],
            ['label'=>'Pendapatan terhadap Total Aset',         'baseline'=>'59,35%','target'=>'—',      'prog'=>100,                     'status'=>'green'],
            ['label'=>'DIPA/APBN terhadap Total Pendapatan',    'baseline'=>'28,21%','target'=>'4,13%',  'prog'=>100,                     'status'=>'green'],
            ['label'=>'Pendapatan Industri / Total Pendapatan', 'baseline'=>'2,7%',  'target'=>'2,74%',  'prog'=>round(2.7/2.74*100,1),   'status'=>'amber'],
            ['label'=>'Dana Abadi terhadap Total Aset',         'baseline'=>'0,04%', 'target'=>'4%',     'prog'=>round(0.04/4*100,1),     'status'=>'red'],
            ['label'=>'Alokasi Riset dari Dana Masyarakat',     'baseline'=>'10,3%', 'target'=>'11,5%',  'prog'=>round(10.3/11.5*100,1),  'status'=>'green'],
            ['label'=>'Alokasi Upskilling Dosen',               'baseline'=>'3,95%', 'target'=>'5%',     'prog'=>round(3.95/5*100,1),     'status'=>'amber'],
            ['label'=>'Alokasi Update Laboratorium',            'baseline'=>'2%',    'target'=>'5%',     'prog'=>round(2/5*100,1),        'status'=>'red'],
        ];

        $alokasi = [
            ['label'=>'Riset',            'baseline'=>'10,3%', 'target'=>'11,5%'],
            ['label'=>'Upskilling Dosen', 'baseline'=>'3,95%', 'target'=>'5%'],
            ['label'=>'Update Lab',       'baseline'=>'2%',    'target'=>'5%'],
        ];

        $iku_meta    = config('iku.9');
        $entri       = InputIku::kode('9')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('9')->where('status', 'valid')->count();

        return view('iku.iku-sembilan', compact(
            'target', 'baseline', 'prog', 'gap', 'sub_rows', 'alokasi',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 10 - Zona Integritas
    public function ikuSepuluh()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 10')->first();

        $baseline    = (int)($targetIku->baseline_2025 ?? 0);
        $target      = (int)($targetIku->target_2026   ?? 2);
        $iku_meta    = config('iku.10');
        $entri       = InputIku::kode('10')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('10')->where('status', 'valid')->count();
        $realisasi   = $jumlahValid; // entri valid = unit yang sudah mengajukan ZI
        $prog        = $target > 0 ? round($realisasi / $target * 100, 1) : 0;

        return view('iku.iku-sepuluh', compact(
            'target', 'baseline', 'realisasi', 'prog',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 11a - Opini WTP
    public function ikuSebelasA()
    {
        $wtp            = DB::table('target_iku')->where('kode_iku', 'IKU 11_WTP')->first();
        $opini_baseline = 'WTP';
        $opini_target   = $wtp->keterangan ?? 'WTP';
        $iku_meta       = config('iku.11a');
        $entri          = InputIku::kode('11a')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid    = InputIku::kode('11a')->where('status', 'valid')->count();

        return view('iku.iku-sebelas', compact(
            'opini_baseline', 'opini_target',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 11b - Predikat SAKIP
    public function ikuSebelasB()
    {
        $sakip = DB::table('target_iku')->where('kode_iku', 'IKU 11_SAKIP')->first();
        $sakip_baseline = 'A';
        $sakip_target   = $sakip->keterangan ?? 'AA';
        $sakip_levels   = [
            ['predikat'=>'D',  'range'=>'<30',    'warna'=>'#ef4444'],
            ['predikat'=>'C',  'range'=>'30–50',  'warna'=>'#f97316'],
            ['predikat'=>'CC', 'range'=>'50–60',  'warna'=>'#eab308'],
            ['predikat'=>'B',  'range'=>'60–70',  'warna'=>'#84cc16'],
            ['predikat'=>'BB', 'range'=>'70–75',  'warna'=>'#22c55e'],
            ['predikat'=>'A',  'range'=>'75–90',  'warna'=>'#06b6d4', 'aktif'=>true],
            ['predikat'=>'AA', 'range'=>'90–100', 'warna'=>'#4f46e5', 'target'=>true],
        ];
        $iku_meta    = config('iku.11b');
        $entri       = InputIku::kode('11b')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('11b')->where('status', 'valid')->count();

        return view('iku.iku-sebelas-b', compact(
            'sakip_baseline', 'sakip_target', 'sakip_levels',
            'iku_meta', 'entri', 'jumlahValid'
        ));
    }

    // IKU 11c - Integritas Akademik
    public function ikuSebelasC()
    {
        $iku_meta    = config('iku.11c');
        $entri       = InputIku::kode('11c')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('11c')->where('status', 'valid')->count();

        return view('iku.iku-sebelas-c', compact('iku_meta', 'entri', 'jumlahValid'));
    }

    // IKU 11d - Anti Kekerasan/Narkoba/Korupsi
    public function ikuSebelasD()
    {
        $iku_meta    = config('iku.11d');
        $entri       = InputIku::kode('11d')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('11d')->where('status', 'valid')->count();

        return view('iku.iku-sebelas-d', compact('iku_meta', 'entri', 'jumlahValid'));
    }

    // IKU 12 - Kesejahteraan Dosen
    public function ikuDuabelas()
    {
        $iku_meta    = config('iku.12');
        $entri       = InputIku::kode('12')->with(['eviden', 'riwayat', 'pembuat'])->latest()->get();
        $jumlahValid = InputIku::kode('12')->where('status', 'valid')->count();

        return view('iku.iku-duabelas', compact('iku_meta', 'entri', 'jumlahValid'));
    }
}