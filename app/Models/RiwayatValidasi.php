<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * RiwayatValidasi — jejak aksi (ajukan/validasi/kembalikan) per entri.
 */
class RiwayatValidasi extends Model
{
    protected $table = 'riwayat_validasi';

    protected $fillable = [
        'input_iku_id', 'aksi', 'catatan', 'dilakukan_oleh',
    ];

    public function input(): BelongsTo
    {
        return $this->belongsTo(InputIku::class, 'input_iku_id');
    }

    public function pelaku(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dilakukan_oleh');
    }

    public function labelAksi(): string
    {
        return [
            'ajukan'           => 'Diajukan ke Direktorat',
            'validasi'         => 'Divalidasi',
            'kembalikan'       => 'Dikembalikan',
            'revisi'           => 'Direvisi',
            'koreksi_metadata' => 'Ajuan Koreksi Metadata',
        ][$this->aksi] ?? ucfirst($this->aksi);
    }
}