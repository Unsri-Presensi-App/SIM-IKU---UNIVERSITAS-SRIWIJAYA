<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * InputIku — entri data IKU yang diinput unit (manual/hybrid).
 */
class InputIku extends Model
{
    protected $table = 'input_iku';

    protected $fillable = [
        'kode_iku', 'fakultas', 'tahun', 'semester', 'triwulan',
        'judul_subjek', 'data_json', 'status', 'catatan',
        'created_by', 'validated_by', 'diajukan_at', 'divalidasi_at',
    ];

    protected $casts = [
        'data_json'     => 'array',
        'diajukan_at'   => 'datetime',
        'divalidasi_at' => 'datetime',
    ];

    // ── Relasi ──────────────────────────────────────────────
    public function eviden(): HasMany
    {
        return $this->hasMany(EvidenIku::class, 'input_iku_id');
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatValidasi::class, 'input_iku_id')->latest();
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    // ── Helper status untuk badge UI ────────────────────────
    public function labelStatus(): string
    {
        return [
            'draft'    => 'Draft',
            'diajukan' => 'Menunggu Validasi',
            'valid'    => 'Valid Direktorat',
            'revisi'   => 'Perlu Revisi',
        ][$this->status] ?? ucfirst($this->status);
    }

    public function kelasBadge(): string
    {
        return [
            'draft'    => 'draft',
            'diajukan' => 'hybrid',
            'valid'    => 'valid',
            'revisi'   => 'risk',
        ][$this->status] ?? 'draft';
    }

    // ── Scope ───────────────────────────────────────────────
    public function scopeKode($q, string $kodeIku)
    {
        return $q->where('kode_iku', $kodeIku);
    }

    public function scopeFakultas($q, ?string $fakultas)
    {
        return $fakultas ? $q->where('fakultas', $fakultas) : $q;
    }
}