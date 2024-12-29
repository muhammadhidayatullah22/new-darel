<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\HafalanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerkembanganSiswaController;
use App\Http\Controllers\SurahController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('menu.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/kelas', function () {
    return view('menu.kelas');
})->name('kelas');

Route::get('/quran', [SurahController::class, 'index'])->name('quran');

Route::get('/laporan', [LaporanController::class, 'filter'])->name('laporan');

Route::get('/profile', function () {
    return view('menu.profile');
})->name('profile');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
Route::get('/siswa/{id}/setoran', [HafalanController::class, 'setoran'])->name('siswa.setoran');

Route::get('/hafalan/{id}/edit', [HafalanController::class, 'edit'])->name('hafalan.edit');
Route::put('/hafalan/{id}', [HafalanController::class, 'update'])->name('hafalan.update');
Route::post('/hafalan', [HafalanController::class, 'store'])->name('hafalan.store');
Route::delete('/hafalan/{id}', [HafalanController::class, 'destroy'])->name('hafalan.destroy');

Route::get('/get-ayat-by-surah/{surahId}', [HafalanController::class, 'getAyatBySurah']);
Route::get('/get-juz-by-ayat/{surahId}/{ayatNumber}', [HafalanController::class, 'getJuzByAyat']);

Route::post('/hafalan/store', [HafalanController::class, 'store'])->name('hafalan.store');

Route::middleware('auth')->group(function () {  
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.resetPassword');
});

Route::get('/surah/{id}', [SurahController::class, 'show'])->name('surah.show');

Route::get('/kelas/perkembangan/{id}',[PerkembanganSiswaController::class, 'show'])->name('kelas.data-perkembangan');

Route::get('/laporan/siswa-data/{id}', [LaporanController::class, 'siswaPerkembangan'])->name('laporan.siswa-data');
Route::post('/laporan/update-data-bulk', [LaporanController::class, 'updateDataBulk'])->name('laporan.updateDataBulk');
