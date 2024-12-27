<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Hafalan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:255',
            'hafalan' => 'nullable|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::create($request->all());

        return response()->json($siswa, 201);
    }

    public function setoran($id)
    {
        $siswa = Siswa::find($id);
        $hafalan = Hafalan::where('siswa_id', $id)->get();
        return view('siswa.setoran', compact('siswa', 'hafalan'));
    }
}
