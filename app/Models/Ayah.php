<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    use HasFactory;

    protected $table = 'ayahs';

    protected $fillable = [
        'surah_id',
        'number',
        'text',
        'number_in_surah',
        'juz',
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}
