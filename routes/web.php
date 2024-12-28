<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\HafalanController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('menu.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/kelas', function () {
    return view('menu.kelas');
})->name('kelas');

Route::get('/quran', function () {
    return view('menu.quran');
})->name('quran');

Route::get('/laporan', function () {
    return view('menu.laporan');
})->name('laporan');

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
