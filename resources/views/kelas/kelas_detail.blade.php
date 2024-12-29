@extends('layouts.navside')

@section('content')
    <div class="w-full mx-auto px-4 py-2" x-data="{ openModal: false, openEditModal: false }">
        <h1 class="mb-4">Detail Kelas</h1>
        <h2>{{ $jenis_kelas }}</h2>
        <p class="mb-4">Kelas: {{ $kelas }} {{ $gender_kelas }}</p>

        <!-- Tabel Siswa -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white dark:bg-gray-900 flex justify-between items-center">
                <!-- Kolom Pencarian -->
                <div class="relative">
                    <input 
                        type="text" 
                        id="table-search" 
                        class="block w-80 pt-2 pl-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Cari nama siswa..."
                        aria-label="Cari nama siswa">
                </div>

                <!-- Tombol Update Data Laporan -->
                @if(auth()->user()->isGuru())    
                <a 
                    href="{{ route('laporan.siswa-data', ['id' => $id]) }}" 
                    class="btn btn-primary btn-sm px-4">
                    Update
                </a>
                @endif
            </div>
            <table id="siswa-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-lg text-white uppercase bg-ma-bg">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Nama</th>
                        <th scope="col" class="px-6 py-3 text-center">NIS</th>
                        <th scope="col" class="px-6 py-3 text-center">Jumlah Hafalan</th>
                        @if(auth()->user()->isGuru())
                            <th scope="col" class="px-6 py-3 text-center">Edit</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 text-sm text-black font-bold uppercase">{{ $s->nama }}</td>
                        <td class="px-6 py-4 text-black font-medium text-center">{{ $s->nis }}</td>
                        <td class="px-6 py-4 text-black font-medium text-center">{{ $s->laporan->last()->jumlah_hafalan ?? 0 }} Juz</td>
                        @if(auth()->user()->isGuru())
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('siswa.setoran', $s->id) }}" method="GET">
                                    <button 
                                        type="submit" 
                                        class="text-white bg-blue-600 hover:bg-blue-700 rounded px-4 py-2">
                                        Edit
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
