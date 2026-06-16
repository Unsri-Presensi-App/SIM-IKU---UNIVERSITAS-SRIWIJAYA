<?php

namespace App\Http\Controllers;

use App\Models\InputIku;
use App\Models\RiwayatValidasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * ValidasiController
 * ------------------------------------------------------------------
 * Aksi Direktorat (validator): memvalidasi atau mengembalikan entri
 * yang berstatus 'diajukan'. Mengisi alur "Validasi Direktorat".
 * ------------------------------------------------------------------
 */
class ValidasiController extends Controller
{
    /** Validasi (setujui) sebuah entri yang diajukan. */
    public function validasi(Request $request, InputIku $input)
    {
        abort_unless(Auth::user()->bisaValidasi(), 403, 'Hanya validator/Direktorat yang dapat memvalidasi.');
        abort_unless($input->status === 'diajukan', 422, 'Entri ini tidak dalam status diajukan.');

        $request->validate(['catatan' => ['nullable', 'string', 'max:1000']]);

        DB::transaction(function () use ($request, $input) {
            $input->update([
                'status'        => 'valid',
                'validated_by'  => Auth::id(),
                'divalidasi_at' => now(),
            ]);
            RiwayatValidasi::create([
                'input_iku_id'   => $input->id,
                'aksi'           => 'validasi',
                'catatan'        => $request->input('catatan'),
                'dilakukan_oleh' => Auth::id(),
            ]);
        });

        return back()->with('sukses', 'Entri berhasil divalidasi.');
    }

    /** Kembalikan entri ke operator untuk revisi. */
    public function kembalikan(Request $request, InputIku $input)
    {
        abort_unless(Auth::user()->bisaValidasi(), 403);
        abort_unless($input->status === 'diajukan', 422);

        $request->validate(['catatan' => ['required', 'string', 'max:1000']], [
            'catatan.required' => 'Catatan alasan pengembalian wajib diisi.',
        ]);

        DB::transaction(function () use ($request, $input) {
            $input->update([
                'status'       => 'revisi',
                'validated_by' => Auth::id(),
            ]);
            RiwayatValidasi::create([
                'input_iku_id'   => $input->id,
                'aksi'           => 'kembalikan',
                'catatan'        => $request->input('catatan'),
                'dilakukan_oleh' => Auth::id(),
            ]);
        });

        return back()->with('sukses', 'Entri dikembalikan ke operator untuk revisi.');
    }
}