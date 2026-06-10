<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iku_satu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');        // Contoh: D3, D4, S1, S2, S3
            $table->string('jenjang');             // Singkatan jenjang
            $table->integer('total_mahasiswa');    // Total mahasiswa masuk
            $table->integer('lulus_tepat_waktu');  // Yang lulus tepat waktu
            $table->decimal('aee_realisasi', 5, 2); // AEE % realisasi
            $table->decimal('aee_ideal', 5, 2);     // AEE % ideal
            $table->decimal('tingkat_pencapaian', 5, 2); // % pencapaian
            $table->integer('tahun_akademik');     // Contoh: 2024
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iku_satu');
    }
};