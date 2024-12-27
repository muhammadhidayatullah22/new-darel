<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::get('/kelas', [KelasController::class, 'index']);
Route::post('/kelas', [KelasController::class, 'store']);
Route::post('/siswa', [SiswaController::class, 'store']);
