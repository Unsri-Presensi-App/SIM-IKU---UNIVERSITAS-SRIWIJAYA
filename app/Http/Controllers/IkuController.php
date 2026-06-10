<?php

namespace App\Http\Controllers;

use App\Models\IkuSatu;

class IkuController extends Controller
{
    public function ikuSatu()
    {
        // Ambil semua data dari database
        $data = IkuSatu::all();

        // Hitung AEE PT = rata-rata tingkat_pencapaian semua program
        $aee_pt = $data->avg('tingkat_pencapaian');

        // Target 2026 (nanti bisa dari database / tabel target)
        $target = 43.13;

        return view('iku.iku-satu', compact('data', 'aee_pt', 'target'));
    }
}