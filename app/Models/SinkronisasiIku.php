<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SinkronisasiIku — log sinkronisasi data untuk IKU OTOMATIS (1, 6, 9).
 */
class SinkronisasiIku extends Model
{
    protected $table = 'sinkronisasi_iku';

    protected $fillable = [
        'kode_iku', 'status', 'sumber_api', 'pesan', 'disinkron_at',
    ];

    protected $casts = [
        'disinkron_at' => 'datetime',
    ];
}