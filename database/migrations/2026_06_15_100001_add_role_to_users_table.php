<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom peran (role) dan unit kerja pada users.
     * - role: operator | validator | admin | viewer
     * - unit_kerja: kode fakultas/unit (FE, FT, ... atau 'Universitas' untuk pusat)
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('operator')->after('password');
            }
            if (!Schema::hasColumn('users', 'unit_kerja')) {
                $table->string('unit_kerja')->nullable()->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = [];
            if (Schema::hasColumn('users', 'role'))       $cols[] = 'role';
            if (Schema::hasColumn('users', 'unit_kerja')) $cols[] = 'unit_kerja';
            if (!empty($cols)) $table->dropColumn($cols);
        });
    }
};