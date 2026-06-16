<?php

namespace App\Http\Controllers;

use App\Models\InputIku;
use App\Models\EvidenIku;
use App\Models\RiwayatValidasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * InputIkuController
 * ------------------------------------------------------------------
 * Menangani input data IKU manual & hybrid (IKU 2,3,4,5,7,8,10,11a-d,12).
 * Alur: operator input → simpan draft → ajukan ke direktorat → validasi.
 * ------------------------------------------------------------------
 */
class InputIkuController extends Controller
{
    /** Daftar kode IKU yang menerima input manual/hybrid. */
    private const KODE_VALID = ['2', '3', '4', '5', '7', '8', '10', '11a', '11b', '11c', '11d', '12'];

    /**
     * Simpan entri baru (draft) atau langsung ajukan.
     * Dipanggil dari form input di halaman IKU.
     */
    public function store(Request $request, string $kode)
    {
        abort_unless(in_array($kode, self::KODE_VALID, true), 404);
        abort_unless(Auth::user()->bisaInput(), 403, 'Anda tidak memiliki akses input.');

        $meta = config("iku.$kode");

        // Validasi dinamis: kumpulkan field dari config IKU.
        $aturan = ['judul_subjek' => ['nullable', 'string', 'max:255']];
        foreach ($meta['fields'] ?? [] as $f) {
            $aturan["data.{$f['name']}"] = ['nullable', 'string', 'max:500'];
        }
        $aturan['triwulan'] = ['nullable', 'integer', 'between:1,4'];
        $aturan['eviden.*'] = ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,xlsx,xls', 'max:10240'];
        $validated = $request->validate($aturan);

        // Tentukan apakah disimpan sebagai draft atau langsung diajukan.
        $ajukan = $request->input('aksi') === 'ajukan';

        $entri = DB::transaction(function () use ($request, $kode, $meta, $validated, $ajukan) {
            // judul_subjek: pakai input, atau ambil field pertama sebagai fallback.
            $judul = $validated['judul_subjek']
                ?? collect($request->input('data', []))->filter()->first()
                ?? ('Entri ' . $meta['nama']);

            $entri = InputIku::create([
                'kode_iku'     => $kode,
                'fakultas'     => Auth::user()->unit_kerja ?? 'Universitas',
                'tahun'        => (int) $request->input('tahun', now()->year),
                'semester'     => (int) $request->input('semester', 1),
                'triwulan'     => $request->input('triwulan'),
                'judul_subjek' => $judul,
                'data_json'    => $request->input('data', []),
                'status'       => $ajukan ? 'diajukan' : 'draft',
                'catatan'      => $request->input('catatan'),
                'created_by'   => Auth::id(),
                'diajukan_at'  => $ajukan ? now() : null,
            ]);

            // Simpan eviden bila ada.
            $this->simpanEviden($request, $entri);

            // Catat riwayat bila langsung diajukan.
            if ($ajukan) {
                RiwayatValidasi::create([
                    'input_iku_id'   => $entri->id,
                    'aksi'           => 'ajukan',
                    'catatan'        => $request->input('catatan'),
                    'dilakukan_oleh' => Auth::id(),
                ]);
            }

            return $entri;
        });

        return back()->with('sukses', $ajukan
            ? 'Data berhasil diajukan ke Direktorat untuk divalidasi.'
            : 'Draft berhasil disimpan.');
    }

    /**
     * Perbarui entri (hanya pemilik & status draft/revisi).
     */
    public function update(Request $request, InputIku $input)
    {
        abort_unless(Auth::user()->bisaInput(), 403);
        abort_unless($input->created_by === Auth::id() || Auth::user()->isAdmin(), 403);
        abort_unless(in_array($input->status, ['draft', 'revisi'], true), 422, 'Entri yang sudah diajukan/valid tidak dapat diubah.');

        $ajukan = $request->input('aksi') === 'ajukan';

        DB::transaction(function () use ($request, $input, $ajukan) {
            $input->update([
                'judul_subjek' => $request->input('judul_subjek', $input->judul_subjek),
                'data_json'    => $request->input('data', $input->data_json),
                'triwulan'     => $request->input('triwulan', $input->triwulan),
                'catatan'      => $request->input('catatan', $input->catatan),
                'status'       => $ajukan ? 'diajukan' : $input->status,
                'diajukan_at'  => $ajukan ? now() : $input->diajukan_at,
            ]);

            $this->simpanEviden($request, $input);

            if ($ajukan) {
                RiwayatValidasi::create([
                    'input_iku_id'   => $input->id,
                    'aksi'           => 'ajukan',
                    'catatan'        => $request->input('catatan'),
                    'dilakukan_oleh' => Auth::id(),
                ]);
            }
        });

        return back()->with('sukses', $ajukan ? 'Data diajukan ke Direktorat.' : 'Perubahan disimpan.');
    }

    /**
     * Hapus entri (pemilik, status draft/revisi saja).
     */
    public function destroy(InputIku $input)
    {
        abort_unless($input->created_by === Auth::id() || Auth::user()->isAdmin(), 403);
        abort_unless(in_array($input->status, ['draft', 'revisi'], true), 422);

        // Hapus file eviden fisik lebih dulu.
        foreach ($input->eviden as $ev) {
            Storage::disk('public')->delete($ev->path_file);
        }
        $input->delete();

        return back()->with('sukses', 'Entri dihapus.');
    }

    /**
     * Helper: simpan file eviden yang diunggah ke disk 'public'.
     */
    private function simpanEviden(Request $request, InputIku $entri): void
    {
        if (!$request->hasFile('eviden')) {
            return;
        }

        foreach ($request->file('eviden') as $file) {
            $path = $file->store("eviden/{$entri->kode_iku}", 'public');
            EvidenIku::create([
                'input_iku_id' => $entri->id,
                'nama_asli'    => $file->getClientOriginalName(),
                'path_file'    => $path,
                'tipe_file'    => strtolower($file->getClientOriginalExtension()),
                'ukuran_byte'  => $file->getSize(),
                'uploaded_by'  => Auth::id(),
            ]);
        }
    }

    /**
     * Sajikan file eviden melalui Laravel (menghindari error 403 dari web server).
     */
    public function serveEviden(EvidenIku $eviden)
    {
        abort_unless(Storage::disk('public')->exists($eviden->path_file), 404);

        return Storage::disk('public')->response(
            $eviden->path_file,
            $eviden->nama_asli,
            ['Content-Disposition' => 'inline; filename="' . addslashes($eviden->nama_asli) . '"']
        );
    }

    /**
     * Hapus satu file eviden.
     */
    public function hapusEviden(EvidenIku $eviden)
    {
        $input = $eviden->input;
        abort_unless($input->created_by === Auth::id() || Auth::user()->isAdmin(), 403);

        Storage::disk('public')->delete($eviden->path_file);
        $eviden->delete();

        return back()->with('sukses', 'Eviden dihapus.');
    }
}