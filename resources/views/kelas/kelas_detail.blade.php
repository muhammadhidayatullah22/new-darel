@extends('layouts.navside')

@section('content')
    <div class="w-full mx-auto mt-4 px-4 py-8">
        <h1 class="mb-4">Detail Kelas</h1>
        <h2>{{ $jenis_kelas }}</h2>
        <p>Kelas: {{ $kelas }} {{ $gender_kelas }}</p>

        <!-- Tabel Siswa -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white dark:bg-gray-900">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari nama siswa...">
                </div>
            </div>
            <table id="siswa-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-lg text-white uppercase bg-ma-bg dark:bg-ma-bg">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Nama</th>
                        <th scope="col" class="px-6 py-3 text-center">NIS</th>
                        <th scope="col" class="px-6 py-3 text-center">Hafalan</th>
                        <th scope="col" class="px-6 py-3 text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-base text-black">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">{{ $s->nama }}</td>
                        <td class="px-6 py-4 text-center">{{ $s->nis }}</td>
                        <td class="px-6 py-4 text-center">{{ $s->hafalan }}</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('siswa.setoran', $s->id) }}" method="GET" style="display:inline;">
                                <button type="submit" class="font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded px-4 py-2">
                                    Edit
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/detail_kelas.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBar = document.getElementById('table-search');
            const tableRows = document.querySelectorAll('#siswa-table tbody tr');

            searchBar.addEventListener('input', function() {
                const searchTerm = searchBar.value.toLowerCase();

                tableRows.forEach(row => {
                    const nama = row.cells[0].textContent.toLowerCase();
                    row.style.display = nama.includes(searchTerm) ? '' : 'none';
                });
            });
        });
    </script>
@endsection
