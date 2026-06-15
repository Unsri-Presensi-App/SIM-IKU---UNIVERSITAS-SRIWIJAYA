<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IkuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Landing & Autentikasi)
|--------------------------------------------------------------------------
| Pengunjung yang mengakses '/' akan langsung diarahkan ke halaman login.
| Halaman login hanya untuk tamu (guest).
*/

// Redirect URL utama langsung ke rute login
Route::redirect('/', '/login');

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
    Route::get('/iku/11', [IkuController::class, 'ikuSebelas'])->name('iku.sebelas');

    Route::get('/iku-1/export-excel', [IkuController::class, 'exportIkuSatuExcel'])->name('iku.satu.export');
});