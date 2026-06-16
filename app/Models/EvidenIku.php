<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * EvidenIku — file bukti pendukung untuk entri input_iku.
 */
class EvidenIku extends Model
{
    protected $table = 'eviden_iku';

    protected $fillable = [
        'input_iku_id', 'nama_asli', 'path_file',
        'tipe_file', 'ukuran_byte', 'uploaded_by',
    ];

    public function input(): BelongsTo
    {
        return $this->belongsTo(InputIku::class, 'input_iku_id');
    }

    // URL publik file (disk 'public' + storage:link)
    public function url(): string
    {
        // Gunakan Storage::url() langsung (lebih ringkas, IDE-friendly)
        return Storage::url($this->path_file);
    }

    // Ukuran file ramah-baca (KB/MB)
    public function ukuranTampil(): string
    {
        $b = (int) $this->ukuran_byte;
        if ($b >= 1048576) return number_format($b / 1048576, 1, ',', '.') . ' MB';
        if ($b >= 1024)    return number_format($b / 1024, 0, ',', '.') . ' KB';
        return $b . ' B';
    }
}