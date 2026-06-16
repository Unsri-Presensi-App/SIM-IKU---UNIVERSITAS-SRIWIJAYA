<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * File eviden/bukti pendukung untuk setiap entri input_iku.
     * Disimpan di local disk (storage/app/public/eviden).
     */
    public function up(): void
    {
        Schema::create('eviden_iku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('input_iku_id')->constrained('input_iku')->cascadeOnDelete();
            $table->string('nama_asli');                 // nama file asli saat upload
            $table->string('path_file');                 // path relatif di disk 'public'
            $table->string('tipe_file', 20)->nullable(); // pdf | jpg | png | xlsx
            $table->unsignedBigInteger('ukuran_byte')->default(0);
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eviden_iku');
    }
};