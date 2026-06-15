<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IkuSatuExport;
use App\Services\MahasiswaService;

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

        // === PLACEHOLDER API TRACER STUDY (DALAM PENGEMBANGAN) ===
        // Realisasi IKU 2 idealnya dari hasil tracer study (responden berbobot, rumus Slovin galat 2,3%).
        // Saat API tracer tersedia, isi realisasi dari sana. Sementara: null (belum tersedia).
        $realisasiTersedia = false;

        return view('iku.iku-dua', [
            'target'            => $targetIku->target_2026 ?? 75,
            'baseline'          => $targetIku->baseline_2025 ?? 73.6,
            'satuan'            => $targetIku->satuan ?? '%',
            'fakultas'          => $targetFakultas,
            'realisasiTersedia' => $realisasiTersedia,
        ]);
    }

    // IKU 3 - Mahasiswa Berprestasi
    public function ikuTiga()
    {
        $targetIku      = DB::table('target_iku')->where('kode_iku', 'IKU 3')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 3')->get();

        return view('iku.iku-tiga', [
            'target'        => $targetIku->target_2026 ?? 30,
            'baseline'      => $targetIku->baseline_2025 ?? 14.9,
            'satuan'        => $targetIku->satuan ?? '%',
            'target_jumlah' => $targetFakultas,
        ]);
    }

    // IKU 4 - Rekognisi Dosen
    public function ikuEmpat()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 4')->first();
        $targetS3  = DB::table('target_iku')->where('kode_iku', 'IKU 4_S3')->first();

        return view('iku.iku-empat', [
            'target'      => $targetIku->target_2026 ?? 44.6,
            'baseline'    => $targetIku->baseline_2025 ?? 37.33,
            'target_s3'   => $targetS3->target_2026 ?? 39.6,
            'baseline_s3' => $targetS3->baseline_2025 ?? 29.75,
            'satuan'      => $targetIku->satuan ?? '%',
        ]);
    }

    // IKU 5 - Kerjasama Industri
    public function ikuLima()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 5')->first();

        return view('iku.iku-lima', [
            'target'     => $targetIku->target_2026 ?? 5,
            'baseline'   => $targetIku->baseline_2025 ?? 0.58,
            'satuan'     => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 6 - Publikasi Internasional
    public function ikuEnam()
    {
        $targetIku      = DB::table('target_iku')->where('kode_iku', 'IKU 6')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 6')->get();

        return view('iku.iku-enam', [
            'target'   => $targetIku->target_2026 ?? 708,
            'baseline' => $targetIku->baseline_2025 ?? 590,
            'satuan'   => $targetIku->satuan ?? 'Artikel',
            'fakultas' => $targetFakultas,
        ]);
    }

    // IKU 7 - SDGs
    public function ikuTujuh()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 7')->first();

        return view('iku.iku-tujuh', [
            'target'     => $targetIku->target_2026 ?? 55,
            'baseline'   => $targetIku->baseline_2025 ?? 36,
            'satuan'     => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 8 - SDM Kebijakan
    public function ikuDelapan()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 8')->first();

        return view('iku.iku-delapan', [
            'target'     => $targetIku->target_2026 ?? 25,
            'baseline'   => $targetIku->baseline_2025 ?? 5,
            'satuan'     => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 9 - Pendapatan Non UKT
    public function ikuSembilan()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 9')->first();

        return view('iku.iku-sembilan', [
            'target'     => $targetIku->target_2026 ?? 15,
            'baseline'   => $targetIku->baseline_2025 ?? 13.3,
            'satuan'     => $targetIku->satuan ?? '%',
            'keterangan' => $targetIku->keterangan ?? '',
        ]);
    }

    // IKU 10 - Zona Integritas
    public function ikuSepuluh()
    {
        $targetIku = DB::table('target_iku')->where('kode_iku', 'IKU 10')->first();

        return view('iku.iku-sepuluh', [
            'target'   => $targetIku->target_2026 ?? 2,
            'baseline' => $targetIku->baseline_2025 ?? 0,
            'satuan'   => $targetIku->satuan ?? 'Unit Kerja',
        ]);
    }

    // IKU 11 - Opini WTP & SAKIP
    public function ikuSebelas()
    {
        // kode_iku WTP di seeder adalah 'IKU 11_WTP'
        $wtp   = DB::table('target_iku')->where('kode_iku', 'IKU 11_WTP')->first();
        $sakip = DB::table('target_iku')->where('kode_iku', 'IKU 11_SAKIP')->first();

        return view('iku.iku-sebelas', [
            'opini_target' => $wtp->keterangan ?? 'WTP',
            'sakip_target' => $sakip->keterangan ?? 'AA',
        ]);
    }
}