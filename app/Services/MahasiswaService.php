<?php

namespace App\Services;

/**
 * ============================================================
 *  MahasiswaService — PLACEHOLDER API DATA MAHASISWA
 * ============================================================
 *  Service ini membungkus akses ke data mahasiswa (aktif & keluar)
 *  yang dipakai untuk perhitungan AEE (IKU 1) dan target IKU 3.
 *
 *  Dua endpoint berikut akan disediakan oleh tim API (Pak Rahmat):
 *    - getJumlahMahasiswaAktif($prodi)  -> int  jumlah mhs aktif per prodi/jenjang
 *    - getJumlahMahasiswaKeluar($prodi) -> array of { jenis_keluar, jumlah }
 *
 *  Untuk sementara KEDUA method memakai data DUMMY/MOCK dengan STRUKTUR
 *  yang IDENTIK dengan API asli, sehingga saat API live cukup mengganti
 *  isi method tanpa mengubah pemanggil (IkuController).
 *
 *  Contoh saat API live (HTTP):
 *      $resp = Http::get(config('services.simak.url').'/mahasiswa-aktif', ['prodi' => $prodi]);
 *      return (int) $resp->json('jumlah');
 *
 *  PENTING: kontrak/format return TIDAK boleh berubah agar alur AEE tetap jalan.
 * ============================================================
 */
class MahasiswaService
{
    /**
     * Mengembalikan jumlah mahasiswa AKTIF untuk sebuah prodi/jenjang.
     *
     * @param  string $prodi  kunci prodi/jenjang. Format sementara "FAKULTAS|JENJANG"
     *                        (mis. "FE|S1", "FASILKOM|D3"). Saat API live, ganti dengan
     *                        kode prodi resmi dari SIMAK.
     * @return int            jumlah mahasiswa aktif; 0 bila data belum tersedia.
     */
    public function getJumlahMahasiswaAktif(string $prodi): int
    {
        // TODO: ganti dengan API call nyata — endpoint: GET /mahasiswa-aktif?prodi={prodi}
        // return (int) Http::get($url, ['prodi' => $prodi])->json('jumlah');

        // --- MOCK SEMENTARA ---
        $mock = $this->mockMahasiswa();

        return $mock[$prodi]['aktif'] ?? 0;
    }

    /**
     * Mengembalikan data mahasiswa KELUAR (pindah, DO, cuti melebihi ketentuan).
     * Sesuai PDF Kepmen 358, mahasiswa keluar TIDAK dihitung dalam cohort AEE.
     *
     * @param  string $prodi
     * @return array  daftar asosiatif: [ ['jenis_keluar' => string, 'jumlah' => int], ... ]
     *                array kosong bila data belum tersedia.
     */
    public function getJumlahMahasiswaKeluar(string $prodi): array
    {
        // TODO: ganti dengan API call nyata — endpoint: GET /mahasiswa-keluar?prodi={prodi}
        // return Http::get($url, ['prodi' => $prodi])->json(); // [{jenis_keluar, jumlah}, ...]

        // --- MOCK SEMENTARA ---
        $mock = $this->mockMahasiswa();

        return $mock[$prodi]['keluar'] ?? [];
    }

    /**
     * Data dummy gabungan agar halaman tetap bisa diuji sebelum API siap.
     * STRUKTUR INI HANYA SEMENTARA — hapus saat API live.
     *
     * Key memakai format "FAKULTAS|JENJANG". Angka [aktif, lulus_tepat_waktu]
     * mengikuti baseline 2025 pada PDF (AEE per jenjang/fakultas).
     * Field 'keluar' dibiarkan kosong dulu (belum ada data riil dari API).
     *
     * @return array<string, array{aktif:int, lulus:int, keluar:array}>
     */
    private function mockMahasiswa(): array
    {
        // [aktif, lulus_tepat_waktu]
        $base = [
            // Agregat tingkat universitas (dipakai mode "Universitas Sriwijaya")
            'Universitas Sriwijaya|D3' => [1566, 269], 'Universitas Sriwijaya|S1' => [33134, 5004],
            'Universitas Sriwijaya|S2' => [2615, 536],  'Universitas Sriwijaya|S3' => [837, 97],

            // Per fakultas (sumber: tabel AEE baseline 2025 PDF)
            'FE|D3' => [733, 126], 'FE|S1' => [2718, 479], 'FE|S2' => [290, 58], 'FE|S3' => [129, 2],
            'FH|S1' => [2158, 350], 'FH|S2' => [413, 83], 'FH|S3' => [110, 6],
            'FT|S1' => [3912, 360], 'FT|S2' => [179, 36], 'FT|S3' => [203, 22],
            'FK|S1' => [2171, 436], 'FK|S2' => [777, 88], 'FK|S3' => [121, 26],
            'FP|S1' => [4691, 679], 'FP|S2' => [92, 19], 'FP|S3' => [33, 7],
            'FKIP|S1' => [5932, 923], 'FKIP|S2' => [357, 134], 'FKIP|S3' => [66, 4],
            'FISIP|S1' => [4531, 605], 'FISIP|S2' => [182, 47], 'FISIP|S3' => [106, 21],
            'FMIPA|S1' => [2724, 526], 'FMIPA|S2' => [76, 19], 'FMIPA|S3' => [34, 9],
            'FASILKOM|D3' => [833, 143], 'FASILKOM|S1' => [2332, 373], 'FASILKOM|S2' => [66, 14], 'FASILKOM|S3' => [16, 0],
            'FKM|S1' => [1965, 275], 'FKM|S2' => [136, 28], 'FKM|S3' => [19, 0],
            'SPS|S2' => [47, 11],
        ];

        $out = [];
        foreach ($base as $key => [$aktif, $lulus]) {
            $out[$key] = [
                'aktif'  => $aktif,
                'lulus'  => $lulus,   // lulus tepat waktu (mock)
                // contoh isi nyata: [['jenis_keluar' => 'DO', 'jumlah' => 3], ['jenis_keluar' => 'Pindah', 'jumlah' => 1]]
                'keluar' => [],
            ];
        }

        return $out;
    }

    /**
     * Helper: jumlah lulus tepat waktu untuk sebuah prodi/jenjang.
     * Sementara dari mock; nanti dari endpoint terkait (mis. /lulus-tepat-waktu).
     *
     * @param  string $prodi
     * @return int
     */
    public function getJumlahLulusTepatWaktu(string $prodi): int
    {
        // TODO: ganti dengan API call nyata — endpoint: GET /lulus-tepat-waktu?prodi={prodi}
        $mock = $this->mockMahasiswa();

        return $mock[$prodi]['lulus'] ?? 0;
    }
}