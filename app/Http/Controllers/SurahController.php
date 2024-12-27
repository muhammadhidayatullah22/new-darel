<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Surah;
use App\Http\Controllers\AyahController;

class SurahController extends Controller
{
    public function import()
    {
        $response = Http::get('http://api.alquran.cloud/v1/quran/id.asad');

        if ($response->successful()) {
            $data = $response->json()['data']['surahs'];

            foreach ($data as $surahData) {
                $surah = Surah::updateOrCreate(
                    ['number' => $surahData['number']],
                    [
                        'name' => $surahData['name'],
                        'english_name' => $surahData['englishName'],
                        'english_name_translation' => $surahData['englishNameTranslation'],
                        'revelation_type' => $surahData['revelationType'],
                    ]
                );

                // Simpan ayahs menggunakan AyahController
                $ayahController = new AyahController();
                foreach ($surahData['ayahs'] as $ayahData) {
                    $ayahController->import($surah->id, $ayahData);
                }
            }   

            return response()->json(['message' => 'Data imported successfully.']);
        }

        return response()->json(['message' => 'Failed to fetch data.'], 500);
    }
}
