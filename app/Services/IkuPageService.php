<?php

namespace App\Services;

use App\Models\InputIku;
use App\Models\SinkronisasiIku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * IkuPageService
 * ------------------------------------------------------------------
 * Merakit data standar yang dibutuhkan setiap halaman IKU (mengikuti
 * struktur mockup): metadata, target/baseline, realisasi (agregat dari
 * entri valid), 4 kartu ringkasan, capaian per triwulan, daftar entri
 * milik unit, dan riwayat sinkronisasi (untuk IKU otomatis).
 *
 * Tujuan: controller cukup memanggil ->bangun($kode) tanpa mengulang
 * logika di tiap method.
 * ------------------------------------------------------------------
 */
class IkuPageService
{
    /**
     * Bangun payload lengkap untuk satu halaman IKU.
     *
     * @param  string      $kode      kode IKU ('2','11a', dst.)
     * @param  string|null $fakultas  filter unit (null = unit user / semua)
     * @return array
     */
    public function bangun(string $kode, ?string $fakultas = null): array
    {
        $meta = config("iku.$kode");

        // Pemetaan kode halaman → kode_iku di tabel target_iku.
        $mapTarget = [
            '11a' => 'IKU 11_WTP',
            '11b' => 'IKU 11_SAKIP',
            '11c' => 'IKU 11_INTEGRITAS',
            '11d' => 'IKU 11_PENCEGAHAN',
            '12'  => 'IKU 12',
        ];
        $kodeTarget = $mapTarget[$kode] ?? ('IKU ' . $kode);

        // Target & baseline dari tabel target_iku.
        $target = DB::table('target_iku')->where('kode_iku', $kodeTarget)->first();

        $baseline = $target->baseline_2025 ?? null;
        $targetVal = $target->target_2026 ?? null;

        // Filter unit: validator/admin lihat semua; operator lihat unitnya.
        $unit = $fakultas;
        if ($unit === null && Auth::check() && Auth::user()->isOperator()) {
            $unit = Auth::user()->unit_kerja;
        }

        // Entri milik unit untuk IKU ini (terbaru dulu).
        $entriQuery = InputIku::kode($kode)->fakultas($unit)->with('eviden', 'pembuat')->latest();
        $entri = $entriQuery->get();

        // Realisasi agregat: dihitung dari entri VALID (placeholder sederhana —
        // jumlah entri valid; rumus presisi per IKU menyusul saat data API siap).
        $jumlahValid = $entri->where('status', 'valid')->count();
        $jumlahDiajukan = $entri->where('status', 'diajukan')->count();
        $jumlahDraft = $entri->where('status', 'draft')->count();

        // Realisasi ditampilkan: untuk sekarang pakai baseline sebagai proxy
        // (data realisasi nyata menyusul). Ditandai jujur di UI.
        $realisasi = $baseline;

        // Capaian terhadap target (progres baseline→target, cap 100% utk visual).
        $capaian = ($targetVal && $targetVal != 0)
            ? min(round(($realisasi / $targetVal) * 100, 2), 999)
            : 0;

        // Empat kartu ringkasan ala mockup: Target / Realisasi / Capaian / Update-Mode.
        $satuan = $meta['satuan'] ?? '%';
        $kartu = [
            ['label' => 'Target 2026',     'value' => $this->fmt($targetVal, $satuan)],
            ['label' => 'Realisasi',        'value' => $this->fmt($realisasi, $satuan)],
            ['label' => 'Capaian Target',   'value' => $capaian ? number_format($capaian, 2, ',', '.') . '%' : '–'],
            ['label' => $meta['tipe'] === 'otomatis' ? 'Update Sumber' : 'Mode Input',
             'value' => $meta['tipe'] === 'otomatis' ? now()->format('d M') : 'Manual'],
        ];

        // Target per triwulan (proporsional: 25/50/75/100% dari target tahunan).
        $tw = [];
        if (is_numeric($targetVal)) {
            foreach ([1 => .25, 2 => .50, 3 => .75, 4 => 1.0] as $i => $f) {
                $tw[] = ['tw' => "TW$i", 'nilai' => $this->fmt(round($targetVal * $f, 2), $satuan)];
            }
        }

        // Riwayat sinkronisasi (khusus IKU otomatis); fallback mock 3 baris.
        $sync = SinkronisasiIku::where('kode_iku', $kode)->latest('disinkron_at')->take(5)->get();

        return [
            'meta'           => $meta,
            'kode'           => $kode,
            'baseline'       => $baseline,
            'target'         => $targetVal,
            'realisasi'      => $realisasi,
            'capaian'        => $capaian,
            'kartu'          => $kartu,
            'triwulan'       => $tw,
            'entri'          => $entri,
            'jumlah_valid'   => $jumlahValid,
            'jumlah_diajukan'=> $jumlahDiajukan,
            'jumlah_draft'   => $jumlahDraft,
            'sync'           => $sync,
            'bisa_input'     => Auth::check() && Auth::user()->bisaInput(),
            'bisa_validasi'  => Auth::check() && Auth::user()->bisaValidasi(),
        ];
    }

    /** Format nilai + satuan (Artikel/Unit/Dokumen → angka bulat; % → 2 desimal). */
    private function fmt($val, string $satuan): string
    {
        if ($val === null) return '–';
        if ($satuan === '%') return number_format($val, 2, ',', '.') . '%';
        if (in_array($satuan, ['Artikel', 'Unit', 'Dokumen', 'Laporan'], true)) {
            return number_format($val, 0, ',', '.') . ' ' . $satuan;
        }
        return (string) $val;
    }
}