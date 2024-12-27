<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use App\Models\Siswa;
use App\Models\Surah;
use App\Models\Hafalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HafalanController extends Controller
{
    // Menampilkan setoran hafalan siswa
    public function setoran($id)
    {
        $siswa = Siswa::findOrFail($id);
        $hafalan = Hafalan::where('siswa_id', $id)->get(); // Ambil setoran hafalan berdasarkan siswa
        $surah = Surah::all(); // Ambil semua data surah

        // Ambil semua juz dari model Ayah
        $juz = Ayah::distinct()->pluck('juz'); // Ambil semua nilai juz yang unik

        // Pastikan untuk mengambil juz dari setiap hafalan
        foreach ($hafalan as $item) {
            $ayahAwal = Ayah::where('number', $item->ayat_awal)->where('surah_id', $item->surah)->first();
            if ($ayahAwal) {
                $item->juz = $ayahAwal->juz;
                $item->surah_name = Surah::find($item->surah)->name; // Ambil nama surah
            } else {
                $item->juz = null; // Atau nilai default
                $item->surah_name = null; // Atau nilai default
            }
            Log::info('Hafalan Juz:', ['juz' => $item->juz]);
        }        

        return view('siswa.setoran', compact('siswa', 'hafalan', 'surah', 'juz')); // Kirim data siswa, hafalan, surah, dan juz ke view
    }

    // Menyimpan hafalan baru
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'ayat_awal' => 'required|integer',
            'ayat_akhir' => 'required|integer',
            'bacaan' => 'required|string',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil data ayah berdasarkan ayat awal dan akhir
        $ayahAwal = Ayah::where('number', $request->ayat_awal)->where('surah_id', $request->surah)->first();
        $ayahAkhir = Ayah::where('number', $request->ayat_akhir)->where('surah_id', $request->surah)->first();

        if (!$ayahAwal || !$ayahAkhir) {
            return redirect()->back()->withErrors(['message' => 'Ayat tidak ditemukan.']);
        }

        // Ambil informasi surah berdasarkan ID
        $surah = Surah::findOrFail($request->surah);

        // Menyimpan data hafalan
        Hafalan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'juz' => $ayahAwal->juz, // Ambil juz dari ayah awal
            'surah' => $surah->id, // Ambil ID surah
            'ayat_awal' => $request->ayat_awal,
            'ayat_akhir' => $request->ayat_akhir,
            'bacaan' => $request->bacaan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Hafalan berhasil ditambahkan.');
    }

    // Mengupdate hafalan yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ayat_awal' => 'required|integer',
            'ayat_akhir' => 'required|integer',
            'bacaan' => 'required|string',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $hafalan = Hafalan::findOrFail($id);

        // Ambil data ayah berdasarkan ayat awal dan akhir
        $ayahAwal = Ayah::where('number', $request->ayat_awal)->where('surah_id', $hafalan->surah)->first();
        $ayahAkhir = Ayah::where('number', $request->ayat_akhir)->where('surah_id', $hafalan->surah)->first();

        if (!$ayahAwal || !$ayahAkhir) {
            return redirect()->back()->withErrors(['message' => 'Ayat tidak ditemukan.']);
        }

        // Ambil informasi surah berdasarkan ID
        $surah = Surah::findOrFail($hafalan->surah);

        // Mengupdate data hafalan
        $hafalan->update([
            'tanggal' => $request->tanggal,
            'juz' => $ayahAwal->juz, // Ambil juz dari ayah awal
            'surah' => $surah->id, // Ambil ID surah
            'ayat_awal' => $request->ayat_awal,
            'ayat_akhir' => $request->ayat_akhir,
            'bacaan' => $request->bacaan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Hafalan berhasil diperbarui.');
    }

    public function getAyatBySurah($surahId)
    {
        Log::info('GetAyatBySurah method called with surahId:', ['surahId' => $surahId]);
        $ayahs = Ayah::where('surah_id', $surahId)->get(['number_in_surah']);
        return response()->json($ayahs);
    }

    // Menghapus setoran hafalan
    public function destroy($id)
    {
        $hafalan = Hafalan::findOrFail($id);
        $hafalan->delete();

        return redirect()->back()->with('success', 'Setoran hafalan berhasil dihapus.');
    }

    // Metode lain yang mungkin Anda perlukan
    // ...

    public function create() // Metode untuk menampilkan form tambah hafalan
    {
        $surah = Surah::all(); // Ambil semua data surah
        return view('siswa.setoran', compact('surah')); // Kirim data surah ke view
    }

    public function edit($id) // Metode untuk menampilkan form edit hafalan
    {
        $hafalan = Hafalan::findOrFail($id);
        $surah = Surah::all(); // Ambil semua data surah
        return view('siswa.setoran', compact('hafalan', 'surah')); // Kirim data hafalan dan surah ke view
    }
}
