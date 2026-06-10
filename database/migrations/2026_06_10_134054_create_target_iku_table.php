<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('target_iku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_iku')->unique();
            $table->string('nama_iku');
            $table->decimal('baseline_2025', 10, 2)->nullable();
            $table->decimal('target_2026', 10, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('target_iku');
    }
};