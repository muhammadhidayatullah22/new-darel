<?php

namespace App\Http\Controllers;

use App\Models\Ayah;

class AyahController extends Controller
{
    public function import($surahId, $ayahData)
    {
        Ayah::updateOrCreate(
            ['number' => $ayahData['number']],
            [
                'surah_id' => $surahId,
                'text' => $ayahData['text'],
                'number_in_surah' => $ayahData['numberInSurah'],
                'juz' => $ayahData['juz'],
            ]
        );
    }
} 