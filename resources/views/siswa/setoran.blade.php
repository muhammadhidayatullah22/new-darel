@extends('layouts.navside')

@section('content')
    <div class="w-full mx-auto mt-8 px-4 py-8" x-data="{ openModal: false, openEditModal: false }">
        <p class="text-lg font-bold uppercase text-left mb-2">Setoran Hafalan Siswa</p>
        <div class="card-body mb-4" style="background: linear-gradient(to right, #4F6F52, #98D59D);">
            <h1 class="text-xs font-thin text-left mb-0">Nama Siswa</h1>
            <h2 class="text-xl font-bold mb-4 text-left">{{ $siswa->nama }}</h2>
            <h1 class="text-xs font-thin text-left mb-0">NIS</h1>
            <h2 class="text-xl font-bold text-left">{{ $siswa->nis }}</h2>
        </div>
        <!-- Search Bar Tanggal -->
        <div class="flex justify-between items-center mb-4">
            <input type="date" id="searchDate" class="form-input form-input-sm border rounded px-2 py-1 w-auto focus:outline-none focus:ring focus:border-blue-300" placeholder="Cari berdasarkan tanggal">
            <button type="button" class="btn btn-primary btn-sm" @click="openModal = true">Tambah</button>
        </div>

        <!-- Tabel Hafalan -->
        <div class="overflow-x-auto">
            <table id="hafalanTable" class="table-auto w-full rounded-lg shadow-lg">
                <thead class="bg-ma-bg text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Tanggal</th>
                        <th class="px-4 py-2 text-center">Juz</th>
                        <th class="px-4 py-2 text-center">Surah</th>
                        <th class="px-4 py-2 text-center">Ayat Awal</th>
                        <th class="px-4 py-2 text-center">Ayat Akhir</th>
                        <th class="px-4 py-2 text-center">Bacaan</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Keterangan</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hafalan as $item)
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="border px-4 py-2">{{ $item->tanggal->format('Y-m-d') }}</td>
                            <td class="border px-4 py-2">{{ $item->juz ? 'Juz '.$item->juz : 'Juz tidak tersedia' }}</td>
                            <td class="border px-4 py-2">{{ $item->surah_name }}</td>
                            <td class="border px-4 py-2">{{ $item->ayat_awal }}</td>
                            <td class="border px-4 py-2">{{ $item->ayat_akhir }}</td>
                            <td class="border px-4 py-2">{{ $item->bacaan }}</td>
                            <td class="border px-4 py-2">{{ $item->status }}</td>
                            <td class="border px-4 py-2">{{ $item->keterangan }}</td>
                            <td class="border px-4 py-2 flex space-x-2">
                                <button class="btn btn-primary btn-sm" @click="openEditModal = true; $nextTick(() => setEditData({{ $item }}))">Edit</button>
                                <form action="{{ route('hafalan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('modals.modals')
    </div>
@endsection
