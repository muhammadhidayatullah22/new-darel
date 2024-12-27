<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Surah;
use App\Http\Controllers\AyahController;

class ImportSurah extends Command
{
    protected $signature = 'import:surah';
    protected $description = 'Impor data surah dari API';

    public function handle()
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

            $this->info('Data imported successfully.');
        } else {
            $this->error('Failed to fetch data.');
        }
    }
}