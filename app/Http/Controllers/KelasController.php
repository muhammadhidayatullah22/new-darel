<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'kelas' => 'required|string|max:255',
            'gender_kelas' => 'required|string|max:255',
            'jenis_kelas' => 'required|string|max:255',
        ]);

        // Debugging: Periksa data yang diterima
        $kelas = Kelas::create($request->all());

        // Kembalikan respons JSON
        return response()->json(['message' => 'Kelas berhasil ditambahkan', 'kelas' => $kelas], 201);
    }

    public function show($id)
    {
        $kelas = Kelas::find($id);

        // Pastikan $kelas tidak null sebelum mengakses propertinya
        if (!$kelas) {
            return response()->json(['message' => 'Kelas not found'], 404);
        }

        $jenis_kelas = $kelas->jenis_kelas;
        $nama_kelas = $kelas->kelas;
        $kelamin_kelas = $kelas->gender_kelas;
        $siswa = Siswa::where('kelas_id', $id)->get();

        return view('kelas.kelas_detail', [
            'id' => $kelas->id,
            'kelas' => $nama_kelas,
            'gender_kelas' => $kelamin_kelas,
            'jenis_kelas' => $jenis_kelas,
            'siswa' => $siswa
        ]);
    }

    public function laporan()
    {
        $kelas = Kelas::all();
        return view('menu.laporan', ['kelas' => $kelas]);
    }
}
