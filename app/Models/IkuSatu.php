<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkuSatu extends Model
{
    protected $table = 'iku_satu';

    protected $fillable = [
        'nama_program',
        'jenjang',
        'total_mahasiswa',
        'lulus_tepat_waktu',
        'aee_realisasi',
        'aee_ideal',
        'tingkat_pencapaian',
        'target_capaian',   // ditambah agar konsisten dgn data tabel di controller/view
        'tahun_akademik',
    ];

    // Pastikan kolom angka di-cast agar perhitungan & number_format aman
    protected $casts = [
        'total_mahasiswa'    => 'integer',
        'lulus_tepat_waktu'  => 'integer',
        'aee_realisasi'      => 'float',
        'aee_ideal'          => 'float',
        'tingkat_pencapaian' => 'float',
        'target_capaian'     => 'float',
    ];
}