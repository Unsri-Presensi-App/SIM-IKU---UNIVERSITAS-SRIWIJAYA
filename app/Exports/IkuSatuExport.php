<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use App\Services\MahasiswaService;

class IkuSatuExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Service data mahasiswa (placeholder API) — diinjeksikan agar konsisten
     * dengan IkuController dan mudah di-swap saat API live.
     */
    public function __construct(
        private MahasiswaService $mahasiswaService
    ) {
    }

    public function array(): array
    {
        // Pembagi rumus "AEE Ideal" (PDF Kepmen hal.4): D3=33, S1=25, S2=50, S3=33.
        $aee_ideal = ['D3' => 33.00, 'S1' => 25.00, 'S2' => 50.00, 'S3' => 33.00];

        // Target Tingkat Pencapaian resmi per jenjang (PDF hal.5), diambil dari seeder
        // (kode_iku 'IKU 1_PENCAPAIAN_*') agar tidak ada hardcode; fallback ke angka PDF.
        $target_pencapaian = [
            'D3' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_D3')->first())->target_2026 ?? 52.05,
            'S1' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_S1')->first())->target_2026 ?? 60.41,
            'S2' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_S2')->first())->target_2026 ?? 41.02,
            'S3' => optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_S3')->first())->target_2026 ?? 35.05,
        ];

        $nama_jenjang = ['D3' => 'Diploma Tiga', 'S1' => 'Sarjana', 'S2' => 'Magister', 'S3' => 'Doktor'];

        $data = [];
        $no = 1;
        $total_pencapaian = 0;
        $jumlah_jenjang = 0;

        foreach (['D3', 'S1', 'S2', 'S3'] as $jenjang) {
            // Ambil data dari service (placeholder API), mode agregat universitas.
            $prodiKey        = 'Universitas Sriwijaya|' . $jenjang;
            $mahasiswa_aktif = $this->mahasiswaService->getJumlahMahasiswaAktif($prodiKey);
            $lulusan         = $this->mahasiswaService->getJumlahLulusTepatWaktu($prodiKey);
            $keluar          = $this->mahasiswaService->getJumlahMahasiswaKeluar($prodiKey);

            // Cohort = aktif - keluar (PDF: pindah/DO/cuti melebihi ketentuan tidak dihitung).
            $cohort = max(0, $mahasiswa_aktif - collect($keluar)->sum('jumlah'));

            // AEE realisasi = lulus tepat waktu / cohort * 100  (PDF Formula a).
            $realisasi = $cohort > 0 ? ($lulusan / $cohort) * 100 : 0;
            // Tingkat Pencapaian = AEE realisasi / AEE ideal * 100  (PDF Formula b).
            $pencapaian = $aee_ideal[$jenjang] > 0 ? ($realisasi / $aee_ideal[$jenjang]) * 100 : 0;

            $total_pencapaian += $pencapaian;
            $jumlah_jenjang++;

            $data[] = [
                $no++,
                $nama_jenjang[$jenjang] ?? $jenjang,
                number_format($cohort, 0, ',', '.'),
                number_format($lulusan, 0, ',', '.'),
                number_format($aee_ideal[$jenjang], 2, ',', '.') . '%',
                number_format($realisasi, 2, ',', '.') . '%',
                number_format($pencapaian, 2, ',', '.') . '%',
                number_format($target_pencapaian[$jenjang] ?? 0, 2, ',', '.') . '%',
            ];
        }

        // Baris rata-rata: AEE PT = rata-rata Tingkat Pencapaian seluruh jenjang (PDF Formula c).
        $rata_rata_pt = $jumlah_jenjang > 0 ? $total_pencapaian / $jumlah_jenjang : 0;
        $target_pt    = optional(DB::table('target_iku')->where('kode_iku', 'IKU 1_PENCAPAIAN_PT')->first())->target_2026 ?? 47.11;

        $data[] = [
            '',
            'RATA-RATA CAPAIAN IKU 1 (AEE PT)',
            '',
            '',
            '',
            '',
            number_format($rata_rata_pt, 2, ',', '.') . '%',
            number_format($target_pt, 2, ',', '.') . '%',
        ];

        return $data;
    }

    public function headings(): array
    {
        return [
            ['LAPORAN CAPAIAN IKU 1 - ANGKA EFISIENSI EDUKASI (AEE PT)'],
            ['Tanggal Unduh: ' . now()->format('d M Y H:i')],
            [
                'No',
                'Jenjang Pendidikan',
                'Total Mahasiswa (Cohort)',
                'Lulus Tepat Waktu',
                'AEE Ideal (%)',
                'Realisasi AEE (%)',
                'Tingkat Pencapaian (%)',
                'Target Pencapaian (%)',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Gabungkan sel untuk Judul & tanggal.
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');

        // Gabungkan sel teks "RATA-RATA" pada baris ke-8 (data baris 4-7, total di 8).
        $sheet->mergeCells('B8:F8');

        // Border seluruh tabel (baris 3 sampai 8).
        $sheet->getStyle('A3:H8')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            1 => ['font' => ['bold' => true, 'size' => 14], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            2 => ['font' => ['italic' => true, 'color' => ['argb' => 'FF666666']], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            3 => [
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFE5E7EB']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
            8 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFEAF2FF']],
            ],
        ];
    }
}