<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    protected $table = 'surahs';

    protected $fillable = [
        'number',
        'name',
        'english_name',
        'english_name_translation',
        'revelation_type',
    ];

    public function ayahs()
    {
        return $this->hasMany(Ayah::class);
    }
}
