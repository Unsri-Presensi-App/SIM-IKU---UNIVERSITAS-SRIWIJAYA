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
        'tahun_akademik',
    ];
}