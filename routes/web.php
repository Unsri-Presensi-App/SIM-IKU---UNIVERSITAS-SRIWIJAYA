<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IkuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputIkuController;
use App\Http\Controllers\ValidasiController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Landing & Autentikasi)
|--------------------------------------------------------------------------
| Landing page tetap dapat diakses publik. Halaman login hanya untuk tamu
| (guest). Registrasi publik SENGAJA tidak disediakan — akun ditambah manual.
*/
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Rute Terproteksi (wajib login)
|--------------------------------------------------------------------------
| Seluruh dashboard & halaman IKU hanya dapat diakses setelah autentikasi.
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/iku/1',  [IkuController::class, 'ikuSatu'])->name('iku.satu');
    Route::get('/iku/2',  [IkuController::class, 'ikuDua'])->name('iku.dua');
    Route::get('/iku/3',  [IkuController::class, 'ikuTiga'])->name('iku.tiga');
    Route::get('/iku/4',  [IkuController::class, 'ikuEmpat'])->name('iku.empat');
    Route::get('/iku/5',  [IkuController::class, 'ikuLima'])->name('iku.lima');
    Route::get('/iku/6',  [IkuController::class, 'ikuEnam'])->name('iku.enam');
    Route::get('/iku/7',  [IkuController::class, 'ikuTujuh'])->name('iku.tujuh');
    Route::get('/iku/8',  [IkuController::class, 'ikuDelapan'])->name('iku.delapan');
    Route::get('/iku/9',  [IkuController::class, 'ikuSembilan'])->name('iku.sembilan');
    Route::get('/iku/10', [IkuController::class, 'ikuSepuluh'])->name('iku.sepuluh');
    Route::get('/iku/11a', [IkuController::class, 'ikuSebelasA'])->name('iku.sebelas.a');
    Route::get('/iku/11b', [IkuController::class, 'ikuSebelasB'])->name('iku.sebelas.b');
    Route::get('/iku/11c', [IkuController::class, 'ikuSebelasC'])->name('iku.sebelas.c');
    Route::get('/iku/11d', [IkuController::class, 'ikuSebelasD'])->name('iku.sebelas.d');
    // Redirect /iku/11 → /iku/11a agar link lama tetap berfungsi
    Route::get('/iku/11',  fn() => redirect()->route('iku.sebelas.a'))->name('iku.sebelas');
    Route::get('/iku/12',  [IkuController::class, 'ikuDuabelas'])->name('iku.duabelas');

    Route::get('/iku-1/export-excel', [IkuController::class, 'exportIkuSatuExcel'])->name('iku.satu.export');

    // ── Input data IKU (manual/hybrid) — hanya operator & admin ──
    Route::middleware('role:operator,admin')->group(function () {
        Route::post('/iku/{kode}/input',  [InputIkuController::class, 'store'])->name('input.store');
        Route::put('/input/{input}',      [InputIkuController::class, 'update'])->name('input.update');
        Route::delete('/input/{input}',   [InputIkuController::class, 'destroy'])->name('input.destroy');
        Route::delete('/eviden/{eviden}', [InputIkuController::class, 'hapusEviden'])->name('eviden.destroy');
    });

    // ── Validasi Direktorat — hanya validator & admin ──
    Route::middleware('role:validator,admin')->group(function () {
        Route::post('/input/{input}/validasi',   [ValidasiController::class, 'validasi'])->name('validasi.terima');
        Route::post('/input/{input}/kembalikan', [ValidasiController::class, 'kembalikan'])->name('validasi.kembalikan');
    });
});