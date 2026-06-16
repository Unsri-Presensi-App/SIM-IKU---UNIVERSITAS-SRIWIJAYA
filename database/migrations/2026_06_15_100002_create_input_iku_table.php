<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel utama entri data IKU yang diinput unit (manual/hybrid).
     * Satu baris = satu entri data (mis. satu rekognisi dosen, satu program SDGs).
     *
     * - kode_iku   : '2','3','4','5','7','8','10','11a','11b','11c','11d','12'
     * - fakultas   : unit pemilik data (FE, FT, ... atau 'Universitas')
     * - tahun      : tahun periode (mis. 2026)
     * - semester   : 1 | 2  (periode input per semester, sesuai keputusan)
     * - triwulan   : 1..4  (capaian dicatat per triwulan)
     * - judul_subjek : ringkasan/nama entri yang tampil di tabel daftar
     * - data_json  : payload fleksibel berisi field spesifik per IKU
     * - status     : draft | diajukan | valid | revisi
     * - catatan    : catatan dari operator
     * - created_by / validated_by : relasi ke users
     */
    public function up(): void
    {
        Schema::create('input_iku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_iku')->index();
            $table->string('fakultas')->nullable()->index();
            $table->integer('tahun')->default(2026);
            $table->unsignedTinyInteger('semester')->default(1);
            $table->unsignedTinyInteger('triwulan')->nullable();
            $table->string('judul_subjek');
            $table->json('data_json')->nullable();
            $table->enum('status', ['draft', 'diajukan', 'valid', 'revisi'])->default('draft')->index();
            $table->text('catatan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('diajukan_at')->nullable();
            $table->timestamp('divalidasi_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_iku');
    }
};