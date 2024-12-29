<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $table = 'data_siswa';

    protected $fillable = [
        'siswa_id', // ID siswa
        'bulan', // Bulan
        'tahun', // Tahun
        'jumlah_hafalan', // Jumlah hafalan
        'juz', // Juz
        'kondisi_bacaan', // Kondisi bacaan
        'keterangan', // Keterangan tambahan
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
