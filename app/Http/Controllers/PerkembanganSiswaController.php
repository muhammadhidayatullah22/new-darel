<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PerkembanganSiswaController extends Controller
{
    public function show($id)
    {
        $kelas = Kelas::find($id);

        // Pastikan $kelas tidak null sebelum mengakses propertinya
        if (!$kelas) {
            return response()->json(['message' => 'Kelas not found'], 404);
        }
        
        // Tambahkan log untuk memeriksa ID kelas
        Log::info('Mencari siswa untuk kelas ID: ' . $id);
        
        $siswa = Siswa::where('kelas_id', $id)->with('dataSiswa')->get();

        // Debugging: Cek data siswa
        Log::info('Data siswa: ', $siswa->toArray());

        return view('kelas.data-perkembangan', [
            'id' => $kelas->id,
            'siswa' => $siswa
        ]);
    }
}