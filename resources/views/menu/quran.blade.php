@extends('layouts.navside')

@section('content')<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quran App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <style>
        .card {
            font-family: 'Amiri', serif;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1), 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <main class="p-4">
        <div id="surah-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($surahs as $surah)
                <div class="bg-gradient-to-b from-[#D4E7C5] to-[#99BC85] text-gray-900 shadow-lg rounded-lg overflow-hidden card transition-transform duration-300" onclick="window.location.href='/surah/{{ $surah->number }}'">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold">Surah {{ $surah->english_name }}</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-lg">Juz: {{ $surah->revelation_type }}</p>
                        <p class="text-lg">Jumlah Ayat: {{ $surah->numberOfAyahs }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>

</html>
@endsection