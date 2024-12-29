@extends('layouts.navside')

@section('content')<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $surah->english_name }} - Quran App</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Amiri', serif;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-green-100 to-green-300 text-gray-900">
    <main class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-4xl font-bold text-center mb-4 text-green-700">{{ $surah->english_name }}</h1>
        <p class="text-gray-600 text-center">Juz: <span class="font-semibold text-green-600">{{ $surah->revelation_type }}</span></p>
        <p class="text-gray-600 text-center">Jumlah Ayat: <span class="font-semibold text-green-600">{{ $jumlahAyat }}</span></p>
        <div class="mt-6 space-y-4">
            @foreach($ayahs as $ayah)
                <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
                    <p class="text-lg">{{ $ayah->text }}</p>
                    <p class="text-sm text-gray-500">Nomor dalam Surah: {{ $ayah->number_in_surah }}</p>
                </div>
            @endforeach
        </div>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">Kembali</a>
    </main>
</body>
</html>
@endsection