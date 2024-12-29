<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Hafalan;
use App\Models\Siswa;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function filter(Request $request)
    {
        // Ambil data jenis kelas
        $jenisKelasList = Kelas::select('jenis_kelas')->distinct()->get();
        $kelasList = Kelas::all();
        $bulanList = Laporan::select(DB::raw('bulan as bulan'))
                            ->distinct()
                            ->get();
        $tahunList = Laporan::select('tahun')->distinct()->get();

        $laporan = null;

        if ($request->has('kelas') && $request->has('bulan') && $request->has('tahun')) {
            $laporan = Laporan::where('kelas_id', $request->kelas)
                            ->where('bulan', $request->bulan)
                            ->where('tahun', $request->tahun)
                            ->with('siswa')
                            ->get();
        }

        return view('Menu.laporan', [
            'jenisKelasList' => $jenisKelasList,
            'kelasList' => $kelasList,
            'bulanList' => $bulanList,
            'tahunList' => $tahunList,
            'laporan' => $laporan
        ]);
    }

    public function siswaPerkembangan($id)
    {
        // Dapatkan siswa berdasarkan kelas
        $siswa = Siswa::where('kelas_id', $id)->get();
        
        // Dapatkan informasi kelas
        $kelas = Kelas::find($id);
        $jenis_kelas = $kelas->jenis ?? 'Tidak Diketahui';
        $kelamin_kelas = $kelas->kelamin ?? 'Tidak Diketahui';

        return view('laporan.siswa-data', compact('siswa', 'kelas', 'jenis_kelas', 'kelamin_kelas', 'id'));
    }

    public function updateDataBulk(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:1900',
            'siswa' => 'required|array',
            'siswa.*.siswa_id' => 'required|exists:siswa,id',
            'siswa.*.jumlah_hafalan' => 'nullable|integer|min:0',
            'siswa.*.juz' => 'nullable|array',
            'siswa.*.juz.*' => 'nullable|integer|min:1|max:30',
            'siswa.*.kondisi_bacaan' => 'nullable|in:A,B+,B,B-,C',
            'siswa.*.keterangan' => 'nullable|string|max:255',
            'siswa.*.hafalan_lancar' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            foreach ($validated['siswa'] as $data) {
                // Pastikan $data['juz'] adalah array
                $juzArray = is_array($data['juz']) ? $data['juz'] : [];
                // Jika $data['juz'] adalah string, gunakan explode
                if (is_string($data['juz'])) {
                    $juzArray = array_map('intval', explode(',', $data['juz']));
                }

                $juzArray = array_unique(array_filter($juzArray)); // Remove duplicates and empty values
                sort($juzArray); // Sort the array for consistency
                
                // Simpan ke database
                $juzString = implode(',', $juzArray); 

                // Calculate jumlah_hafalan
                $jumlahHafalan = count($juzArray);

                // Update or create the laporan
                Laporan::updateOrCreate(
                    [
                        'siswa_id' => $data['siswa_id'],
                        'kelas_id' => $validated['kelas_id'],
                        'bulan' => $validated['bulan'],
                        'tahun' => $validated['tahun'],
                    ],
                    [
                        'jumlah_hafalan' => $jumlahHafalan,
                        'juz' => $juzString,
                        'kondisi_bacaan' => $data['kondisi_bacaan'] ?? null,
                        'keterangan' => $data['keterangan'] ?? null,
                        'hafalan_lancar' => $data['hafalan_lancar'] ?? null,
                    ]
                );
            }
            DB::commit();
            return redirect()->back()->with('success', 'Data laporan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
}
