<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IkuSatuExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    public function array(): array
    {
        $raw = [
            'D3' => [1566, 269], 
            'S1' => [33134, 5004], 
            'S2' => [2615, 536], 
            'S3' => [837, 97]
        ];
        $aee_ideal = ['D3' => 33.00, 'S1' => 25.00, 'S2' => 50.00, 'S3' => 33.00];
        $target_pk = ['D3' => 51.50, 'S1' => 50.00, 'S2' => 40.00, 'S3' => 31.00];

        $data = [];
        $no = 1;
        $total_pencapaian = 0;

        foreach (['D3', 'S1', 'S2', 'S3'] as $jenjang) {
            $mahasiswa_aktif = $raw[$jenjang][0];
            $lulusan = $raw[$jenjang][1];
            
            $realisasi = $mahasiswa_aktif > 0 ? ($lulusan / $mahasiswa_aktif) * 100 : 0;
            $pencapaian = $aee_ideal[$jenjang] > 0 ? ($realisasi / $aee_ideal[$jenjang]) * 100 : 0;
            $persentase_akhir = $target_pk[$jenjang] > 0 ? ($pencapaian / $target_pk[$jenjang]) * 100 : 0;
            
            $total_pencapaian += $persentase_akhir;

            $data[] = [
                $no++,
                'Program ' . $jenjang,
                number_format($mahasiswa_aktif, 0, ',', '.'),
                number_format($lulusan, 0, ',', '.'),
                number_format($aee_ideal[$jenjang], 2, ',', '.') . '%',
                number_format($target_pk[$jenjang], 2, ',', '.') . '%',
                number_format($realisasi, 2, ',', '.') . '%',
                number_format($persentase_akhir, 2, ',', '.') . '%'
            ];
        }

        // Menambahkan Baris Total Rata-Rata di paling bawah
        $rata_rata_pt = $total_pencapaian / 4;
        $data[] = [
            '', // No
            'RATA-RATA CAPAIAN IKU 1 (AEE PT)', // Jenjang Pendidikan
            '', // Mahasiswa Aktif
            '', // Lulusan
            '', // AEE Ideal
            '', // Target PK
            '', // Realisasi
            number_format($rata_rata_pt, 2, ',', '.') . '%' // Persentase Akhir
        ];

        return $data;
    }

    public function headings(): array
    {
        return [
            ['LAPORAN CAPAIAN IKU 1 - ANGKA EFISIENSI EDUKASI (AEE PT)'],
            ['Tanggal Unduh: ' . now()->format('d M Y H:i')], // Tambahan info waktu
            [
                'No',
                'Jenjang Pendidikan',
                'Total Mahasiswa Aktif',
                'Total Lulusan',
                'AEE Ideal (%)',
                'Target PK Rektor (%)',
                'Realisasi AEE (%)',
                'Persentase Capaian (%)'
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Gabungkan sel untuk Judul
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');
        
        // Gabungkan sel untuk teks "RATA-RATA" di baris ke-8 (Data baris 4 sampai 7, total di 8)
        $sheet->mergeCells('B8:G8');

        // Memberikan border untuk seluruh tabel (Baris 3 sampai 8)
        $sheet->getStyle('A3:H8')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            // Style Judul Utama
            1 => ['font' => ['bold' => true, 'size' => 14], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            // Style Tanggal
            2 => ['font' => ['italic' => true, 'color' => ['argb' => 'FF666666']], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            // Style Header Tabel
            3 => [
                'font' => ['bold' => true], 
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFE5E7EB']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ],
            // Style Baris Rata-Rata (Baris ke-8)
            8 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFEaf2ff']]
            ],
        ];
    }
}