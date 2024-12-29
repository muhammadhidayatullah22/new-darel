<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hafalan;
use App\Models\DataSiswa;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = ['nama', 'nis', 'hafalan', 'kelas_id'];


    public function hafalan()
    {
        return $this->hasMany(Hafalan::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}

