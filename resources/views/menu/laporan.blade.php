@extends('layouts.navside')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Laporan Hafalan Santri</h1>
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <!-- Header Kop Surat -->
        <!-- Header Kop Surat -->
<div class="mb-8 text-center print:text-center">
    <h2 class="text-3xl font-extrabold text-gray-700 uppercase">Rekapitulasi Perkembangan Hafalan Santri Kelas Tahfidz</h2>
    <p class="text-lg text-gray-600">Pondok Pesantren Dar El Hikmah Pekanbaru</p>
    <p class="text-lg text-gray-600">Tahun 2024</p>
</div>

<!-- Informasi Kelas dan Bulan -->
<div class="text-left print:text-left">
    <p class="text-lg font-semibold text-gray-700">JENIS KELAS : {{ request('jenis_kelas') }}</p>
    <p class="text-lg font-semibold text-gray-700">KELAS : {{ $kelasList->firstWhere('id', request('kelas'))->kelas ?? 'Tidak Ditemukan' }} - {{ $kelasList->firstWhere('id', request('kelas'))->gender_kelas ?? 'Tidak Ditemukan' }}</p>
    <p class="text-lg font-semibold text-gray-700">BULAN : {{ date('F', mktime(0, 0, 0, request('bulan'), 10)) }} {{ request('tahun') }}</p>
</div>
        <form class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4" method="GET" action="{{ route('laporan') }}">
            <div class="flex flex-col w-full md:w-1/3">
                <label for="jenis_kelas" class="font-semibold mb-2">Jenis Kelas</label>
                <select id="jenis_kelas" name="jenis_kelas" class="border rounded p-2">
                    <option value="">Pilih Jenis Kelas</option>
                    @foreach($jenisKelasList as $jenis)
                        <option value="{{ $jenis->jenis_kelas }}">{{ $jenis->jenis_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-full md:w-1/3">
                <label for="kelas" class="font-semibold mb-2">Kelas</label>
                <select id="kelas" name="kelas" class="border rounded p-2">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" data-jenis="{{ $kelas->jenis_kelas }}">
                            {{ $kelas->kelas }} - {{ $kelas->gender_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-full md:w-1/3">
                <label for="bulan" class="font-semibold mb-2">Bulan</label>
                <select id="bulan" name="bulan" class="border rounded p-2">
                    <option value="">Pilih Bulan</option>
                    @foreach($bulanList as $bulan)
                        <option value="{{ $bulan->bulan }}">{{ date('F', mktime(0, 0, 0, $bulan->bulan, 10)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-full md:w-1/3">
                <label for="tahun" class="font-semibold mb-2">Tahun</label>
                <select id="tahun" name="tahun" class="border rounded p-2">
                    <option value="">Pilih Tahun</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded mt-4 md:mt-0">Cari</button>
        </form>

        @if($laporan)
            <div class="mt-6">
                <button onclick="printTable()" class="bg-blue-500 text-white px-4 py-2 rounded"><i class="fas fa-print"></i> Print</button>
            </div>
            <div class="overflow-x-auto mt-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2 bg-gray-200">No</th>
                            <th class="border p-2 bg-gray-200">Nama</th>
                            <th class="border p-2 bg-gray-200">Jumlah Hafalan</th>
                            <th class="border p-2 bg-gray-200">Juz</th>
                            <th class="border p-2 bg-gray-200">Kondisi Bacaan</th>
                            <th class="border p-2 bg-gray-200">Hafalan yang Lancar</th>
                            <th class="border p-2 bg-gray-200">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $index => $dataLaporan)
                            <tr>
                                <td class="border p-2">{{ $index + 1 }}</td>
                                <td class="border p-2">{{ $dataLaporan->siswa->nama }}</td>
                                <td class="border p-2">{{ $dataLaporan->jumlah_hafalan ?: '2 juz' }}</td>
                                <td class="border p-2">{{ $dataLaporan->juz ?: '30, 1'}}</td>
                                <td class="border p-2">{{ $dataLaporan->kondisi_bacaan }}</td>
                                <td class="border p-2">{{ $dataLaporan->hafalan_lancar ?: '1,5 juz' }}</td>
                                <td class="border p-2">{{ $dataLaporan->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <style>
        @media print {
            .text-center {
                text-align: center !important;
            }
            .print\:text-left {
                text-align: left !important;
            }
        }
    </style>
    

    <script>
        function printTable() {
    // Mengambil elemen header (judul dan informasi kelas) dan tabel
    var headerContents = document.querySelector('.text-center').outerHTML + document.querySelector('.print\\:text-left').outerHTML;
    var tableContents = document.querySelector('table').outerHTML;

    // Membuka jendela baru untuk cetak
    var newWindow = window.open('', '', 'height=500,width=800');
    newWindow.document.write('<!DOCTYPE html>');
    newWindow.document.write('<html><head><title>Print</title>');
    newWindow.document.write('<meta charset="UTF-8">');
    newWindow.document.write('<style>');
    newWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; }');
    newWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 20px; }');
    newWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
    newWindow.document.write('th { background-color: #f2f2f2; }');
    newWindow.document.write('.text-center { text-align: center; margin-bottom: 20px; }');
    newWindow.document.write('.print\\:text-left { text-align: left; margin-top: 10px; }');
    newWindow.document.write('</style>');
    newWindow.document.write('</head><body>');
    
    // Menulis konten header dan tabel ke dalam dokumen baru
    newWindow.document.write(headerContents);
    newWindow.document.write(tableContents);
    newWindow.document.write('</body></html>');

    // Menutup dokumen dan memulai proses cetak
    newWindow.document.close();
    newWindow.print();
}


        document.getElementById('jenis_kelas').addEventListener('change', function() {
            var jenis = this.value;
            var kelasOptions = document.getElementById('kelas').options;
            for (var i = 0; i < kelasOptions.length; i++) {
                var option = kelasOptions[i];
                option.style.display = option.getAttribute('data-jenis') === jenis || option.value === '' ? 'block' : 'none';
            }
        });
    </script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
@endsection
