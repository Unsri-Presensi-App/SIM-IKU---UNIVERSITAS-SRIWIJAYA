<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IkuController;

Route::get('/', function () {
    return redirect()->route('iku.satu');
});

Route::get('/iku/1', [IkuController::class, 'ikuSatu'])->name('iku.satu');