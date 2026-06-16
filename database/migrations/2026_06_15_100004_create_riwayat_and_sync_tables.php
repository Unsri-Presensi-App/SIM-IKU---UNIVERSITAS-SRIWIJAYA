<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Dua tabel log:
     * 1. riwayat_validasi — jejak aksi tiap entri (ajukan/validasi/kembalikan)
     * 2. sinkronisasi_iku — jejak sinkronisasi data untuk IKU OTOMATIS (1,6,9)
     */
    public function up(): void
    {
        Schema::create('riwayat_validasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('input_iku_id')->constrained('input_iku')->cascadeOnDelete();
            // aksi: ajukan | validasi | kembalikan | revisi | koreksi_metadata
            $table->string('aksi', 30);
            $table->text('catatan')->nullable();
            $table->foreignId('dilakukan_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('sinkronisasi_iku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_iku')->index();
            $table->enum('status', ['berhasil', 'gagal'])->default('berhasil');
            $table->string('sumber_api')->nullable();   // mis. 'API Data Lake', 'SINTA/Scopus'
            $table->text('pesan')->nullable();
            $table->timestamp('disinkron_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_validasi');
        Schema::dropIfExists('sinkronisasi_iku');
    }
};