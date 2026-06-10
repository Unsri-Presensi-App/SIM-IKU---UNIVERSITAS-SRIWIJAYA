<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisasi_iku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_iku');
            $table->string('fakultas')->nullable();
            $table->integer('tahun');
            $table->string('periode')->nullable();
            $table->decimal('nilai', 10, 2)->nullable();
            $table->string('file_bukti')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi_iku');
    }
};