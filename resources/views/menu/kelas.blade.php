@extends('layouts.navside')

@section('content')
<div class="w-full mx-auto px-4 py-2">
    <h1 class="text-4xl font-bold text-gray-900 mb-10">Kelas</h1>

    <div id="kelas-kolom" class="grid grid-cols-1 md:grid-cols-3 gap-12 mx-auto">
        <!-- Kolom MTS -->
        <div class="bg-mts-bg shadow-md rounded-lg p-6 ">
            <h2 class="text-sm font-semibold text-gray-800 mb-4 border-b border-black pb-2">MTS</h2>
            <ul id="mts-list" class="flex flex-col gap-4">
                <!-- Daftar kelas MTS -->
                
            </ul>
        </div>
    
        <!-- Kolom MA -->
        <div class="bg-mts-bg shadow-md rounded-lg p-6">
            <h2 class="text-sm font-semibold text-gray-800 mb-4 border-b border-black pb-2">MA</h2>
            <ul id="ma-list" class="flex flex-col gap-4">
                <!-- Daftar kelas MA -->
                
            </ul>
        </div>
    
        <!-- Kolom SMK -->
        <div class="bg-mts-bg shadow-md rounded-lg p-6">
            <h2 class="text-sm font-semibold text-gray-800 mb-4 border-b border-black pb-2">SMK</h2>
            <ul id="smk-list" class="flex flex-col gap-4">
                <!-- Daftar kelas SMK -->
                
            </ul>
        </div>
    </div>
</div>

<!-- Link to JavaScript -->
<script src="{{ asset('js/kelas.js') }}" defer></script>
@endsection
