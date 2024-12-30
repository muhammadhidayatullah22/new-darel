<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\HafalanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerkembanganSiswaController;
use App\Http\Controllers\SurahController;
use App\Http\Middleware\CheckRole;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('login');
})->name('login');

// Rute untuk dashboard
Route::get('/dashboard', function () {
    // Mendapatkan jumlah total pengguna
    $totalUsers = User::count();
    
    // Mendapatkan jumlah pengguna online (berdasarkan aktivitas sesi)
    $onlineUsers = DB::table('sessions')
        ->where('last_activity', '>=', now()->subMinutes(5)) // Sesuaikan dengan kriteria Anda
        ->whereNotNull('user_id')
        ->count();
    
    // Opsional, Anda dapat mengambil semua sesi
    $sessions = DB::table('sessions')->get();

    // Kirimkan data ke tampilan dashboard
    return view('menu.dashboard', compact('totalUsers', 'onlineUsers', 'sessions'));
})->middleware('auth')->name('dashboard');

// Rute lainnya...



// Rute untuk kelas
Route::get('/kelas', function () {
    return view('menu.kelas');
})->name('kelas');
Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
Route::get('/kelas/perkembangan/{id}', [PerkembanganSiswaController::class, 'show'])->name('kelas.data-perkembangan');

// Rute untuk profil


// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

// Rute untuk hafalan
Route::get('/hafalan/{id}/edit', [HafalanController::class, 'edit'])->name('hafalan.edit');
Route::put('/hafalan/{id}', [HafalanController::class, 'update'])->name('hafalan.update');
Route::post('/hafalan', [HafalanController::class, 'store'])->name('hafalan.store');
Route::delete('/hafalan/{id}', [HafalanController::class, 'destroy'])->name('hafalan.destroy');

// Rute untuk laporan
Route::get('/laporan', [LaporanController::class, 'filter'])->name('laporan');
Route::post('/laporan/update-data-bulk', [LaporanController::class, 'updateDataBulk'])->name('laporan.updateDataBulk');

Route::middleware([CheckRole::class])->group(function () {
    Route::get('/siswa/{id}/setoran', [HafalanController::class, 'setoran'])->name('siswa.setoran');
    Route::get('/laporan/siswa-data/{id}', [LaporanController::class, 'siswaPerkembangan'])->name('laporan.siswa-data');
});

// Rute untuk surah
Route::get('/quran', [SurahController::class, 'index'])->name('quran');
Route::get('/surah/{id}', [SurahController::class, 'show'])->name('surah.show');

// Rute untuk mendapatkan ayat dan juz
Route::get('/get-ayat-by-surah/{surahId}', [HafalanController::class, 'getAyatBySurah']);
Route::get('/get-juz-by-ayat/{surahId}/{ayatNumber}', [HafalanController::class, 'getJuzByAyat']);

// Rute untuk pengaturan profil
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.resetPassword');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('menu.profile');
    })->name('profile');
});