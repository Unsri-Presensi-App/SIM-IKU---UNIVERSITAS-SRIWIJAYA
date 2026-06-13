<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IkuSatuExport;

class IkuController extends Controller
{
    /**
     * ============================================================
     *  PLACEHOLDER API DATA MAHASISWA (DALAM PENGEMBANGAN — Pak Rahmat)
     * ============================================================
     *  Dua endpoint berikut akan disediakan oleh dosen (Rahmat):
     *    - getJumlahMahasiswaAktif($prodi)  -> int jumlah mhs aktif per prodi
     *    - getJumlahMahasiswaKeluar($prodi) -> array of { jenis_keluar, jumlah }
     *
     *  Untuk sementara KEDUA method di bawah memakai data DUMMY/MOCK.
     *  GANTI isi method ini dengan panggilan API/HTTP yang sesungguhnya
     *  begitu API sudah siap, mis:
     *      $resp = Http::get(config('services.simak.url')."/mahasiswa-aktif", ['prodi'=>$prodi]);
     *      return (int) $resp->json('jumlah');
     *
     *  Kontrak/format return TIDAK boleh berubah agar alur AEE tetap jalan.
     * ============================================================
     */

    /**
     * Mengembalikan jumlah mahasiswa AKTIF untuk sebuah prodi/jenjang.
     * @param  string $prodi  kode prodi/jenjang (mis. "FE|S1", "S1", dst.)
     * @return int|null  null bila data belum tersedia
     */
    private function getJumlahMahasiswaAktif(string $prodi): ?int
    {
        // TODO: Ganti dengan panggilan API asli dari Pak Rahmat.
        // return (int) Http::get($url, ['prodi' => $prodi])->json('jumlah');

        // --- MOCK SEMENTARA ---
        $mock = $this->mockMahasiswa();
        return $mock[$prodi]['aktif'] ?? null;
    }

    /**
     * Mengembalikan data mahasiswa KELUAR (pindah, DO, cuti melebihi ketentuan).
     * @param  string $prodi
     * @return array  daftar { jenis_keluar, jumlah }; kosong bila belum tersedia
     */
    private function getJumlahMahasiswaKeluar(string $prodi): array
    {
        // TODO: Ganti dengan panggilan API asli dari Pak Rahmat.
        // return Http::get($url, ['prodi' => $prodi])->json(); // [{jenis_keluar, jumlah}, ...]

        // --- MOCK SEMENTARA ---
        $mock = $this->mockMahasiswa();
        return $mock[$prodi]['keluar'] ?? [];
    }

    /**
     * Data dummy gabungan agar halaman tetap bisa diuji sebelum API siap.
     * STRUKTUR INI HANYA SEMENTARA — hapus saat API live.
     * Key memakai format "FAKULTAS|JENJANG".
     */
    private function mockMahasiswa(): array
    {
        // [aktif, lulus_tepat_waktu]; keluar dibiarkan kosong dulu (belum ada data riil)
        $base = [
            'Universitas Sriwijaya|D3'=>[1566,269], 'Universitas Sriwijaya|S1'=>[33134,5004],
            'Universitas Sriwijaya|S2'=>[2615,536],  'Universitas Sriwijaya|S3'=>[837,97],
            'FE|D3'=>[733,126], 'FE|S1'=>[2718,479], 'FE|S2'=>[290,58], 'FE|S3'=>[129,2],
            'FH|S1'=>[2158,350], 'FH|S2'=>[413,83], 'FH|S3'=>[110,6],
            'FT|S1'=>[3912,360], 'FT|S2'=>[179,36], 'FT|S3'=>[203,22],
            'FK|S1'=>[2171,436], 'FK|S2'=>[777,88], 'FK|S3'=>[121,26],
            'FP|S1'=>[4691,679], 'FP|S2'=>[92,19], 'FP|S3'=>[33,7],
            'FKIP|S1'=>[5932,923], 'FKIP|S2'=>[357,134], 'FKIP|S3'=>[66,4],
            'FISIP|S1'=>[4531,605], 'FISIP|S2'=>[182,47], 'FISIP|S3'=>[106,21],
            'FMIPA|S1'=>[2724,526], 'FMIPA|S2'=>[76,19], 'FMIPA|S3'=>[34,9],
            'FASILKOM|D3'=>[833,143], 'FASILKOM|S1'=>[2332,373], 'FASILKOM|S2'=>[66,14], 'FASILKOM|S3'=>[16,0],
            'FKM|S1'=>[1965,275], 'FKM|S2'=>[136,28], 'FKM|S3'=>[19,0],
            'SPS|S2'=>[47,11],
        ];
        $out = [];
        foreach ($base as $key => [$aktif, $lulus]) {
            $out[$key] = [
                'aktif'  => $aktif,
                'lulus'  => $lulus,   // lulus tepat waktu (mock)
                'keluar' => [],       // contoh isi: [['jenis_keluar'=>'DO','jumlah'=>0]]
            ];
        }
        return $out;
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

        // 5. Ambil Target Utama Universitas (AEE PT) dari Seeder.
        //    Sumber resmi: matriks Kontrak Kinerja Rektor (PDF hal.2) => Target AEE PT 2026 = 43,13%.
        $targetIku   = DB::table('target_iku')->where('kode_iku', 'IKU 1')->first();
        $targetAeePT = $targetIku->target_2026 ?? 43.13;

        // PEMBAGI RUMUS AEE / "AEE Ideal" (PDF Kepmen hal.4): D3=33, S1=25, S2=50, S3=33
        $aee_ideal_map = ['D3' => 33.00, 'S1' => 25.00, 'S2' => 50.00, 'S3' => 33.00];

        // TARGET KINERJA REKTOR per jenjang (PDF matriks PK hal.2): D3=51,5 S1=50 S2=40 S3=31
        $target_pk_map = ['D3' => 51.50, 'S1' => 50.00, 'S2' => 40.00, 'S3' => 31.00];

        $nama_jenjang = ['D3' => 'Diploma Tiga', 'S1' => 'Sarjana', 'S2' => 'Magister', 'S3' => 'Doktor'];

        // 6. Susun data tabel per jenjang dari API (mock) — siap menerima data asli nanti.
        $jenjangList      = $jenjangPerFakultas[$selectedFakultas] ?? [];
        $dataTabel        = [];
        $dataBelumLengkap = false; // flag: ada jenjang yang datanya belum tersedia dari API

        foreach ($jenjangList as $jenjang) {
            // Kunci prodi untuk API. Saat API riil siap, ganti dgn kode prodi sebenarnya.
            $prodiKey = $selectedFakultas . '|' . $jenjang;

            // === Panggil API (placeholder) ===
            $aktif  = $this->getJumlahMahasiswaAktif($prodiKey);
            $keluar = $this->getJumlahMahasiswaKeluar($prodiKey);

            // Bila API belum mengembalikan data, tandai & lewati baris ini dengan aman.
            if ($aktif === null) {
                $dataBelumLengkap = true;
                continue;
            }

            // Total mahasiswa keluar (pindah + DO + cuti melebihi ketentuan) dari struktur API.
            $totalKeluar = collect($keluar)->sum('jumlah');

            // Lulus tepat waktu: sementara dari mock; nanti dari endpoint terkait.
            $lulus = $this->mockMahasiswa()[$prodiKey]['lulus'] ?? 0;

            // Cohort = aktif dikurangi yang keluar (PDF: pindah/DO/cuti tidak dihitung).
            $cohort = max(0, $aktif - $totalKeluar);

            // AEE realisasi = lulus tepat waktu / cohort * 100  (PDF Formula a)
            $realisasi  = $cohort > 0 ? ($lulus / $cohort) * 100 : 0;
            $ideal      = $aee_ideal_map[$jenjang] ?? 0;
            // Tingkat Pencapaian AEE = realisasi / ideal * 100  (PDF Formula b)
            $pencapaian = $ideal > 0 ? ($realisasi / $ideal) * 100 : 0;
            $target_pk  = $target_pk_map[$jenjang] ?? 0;

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

        // 8. % capaian terhadap target PK (untuk kartu ringkasan, makna jelas)
        $capaian_thd_target = $targetAeePT > 0 ? ($aee_pt / $targetAeePT) * 100 : 0;

        return view('iku.iku-satu', compact(
            'dataTabel',
            'aee_pt',
            'targetAeePT',
            'capaian_thd_target',
            'selectedFakultas',
            'selectedTahun',
            'listFakultas',
            'dataBelumLengkap'
        ));
    }

    public function exportIkuSatuExcel()
    {
        return Excel::download(new IkuSatuExport, 'Laporan_IKU_1_AEE.xlsx');
    }

    // IKU 2 - Lulusan Bekerja
    public function ikuDua()
    {
        $targetIku      = DB::table('target_iku')->where('kode_iku', 'IKU 2')->first();
        $targetFakultas = DB::table('target_fakultas')->where('kode_iku', 'IKU 2')->get();

        // Agregat per fakultas (TOTAL pada PDF hal.20): baseline 73,57% -> target 75%.
        // CATATAN: angka ini rata-rata TERTIMBANG per jumlah lulusan (bukan rata-rata sederhana),
        // sehingga diambil langsung dari nilai resmi PDF.
        $aggBaseline = 73.57;
        $aggTarget   = 75.00;

        // === PLACEHOLDER API TRACER STUDY (DALAM PENGEMBANGAN) ===
        // Realisasi IKU 2 idealnya dari hasil tracer study (responden berbobot, rumus Slovin galat 2,3%).
        // Saat API tracer tersedia, isi $realisasiFak dari sana. Sementara: null (belum tersedia).
        // Struktur target diharapkan: getTracerStudy($fakultas) -> ['responden'=>, 'memenuhi'=>, 'persen'=>]
        $realisasiTersedia = false; // true bila data realisasi tracer sudah masuk

        return view('iku.iku-dua', [
            'target'             => $targetIku->target_2026 ?? 73,
            'baseline'           => $targetIku->baseline_2025 ?? 71,
            'satuan'             => $targetIku->satuan ?? '%',
            'fakultas'           => $targetFakultas,
            'aggBaseline'        => $aggBaseline,
            'aggTarget'          => $aggTarget,
            'realisasiTersedia'  => $realisasiTersedia,
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