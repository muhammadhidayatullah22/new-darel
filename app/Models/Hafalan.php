<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalan';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'juz',
        'surah',
        'ayat_awal',
        'ayat_akhir',
        'bacaan',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
