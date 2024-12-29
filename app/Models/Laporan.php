<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'jumlah_hafalan',
        'juz',
        'kondisi_bacaan',
        'hafalan_lancar',
        'keterangan',
        'bulan',
        'tahun'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
