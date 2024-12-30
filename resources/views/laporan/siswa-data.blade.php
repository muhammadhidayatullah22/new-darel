@extends('layouts.navside')

@section('content')
<div class="bg-white rounded-lg shadow-lg w-full max-w-screen-lg mx-auto max-h-screen overflow-y-auto">
    <div class="flex justify-between items-center border-b p-4 sticky top-0 bg-white z-10">
        <h5 class="text-lg font-bold">Tambah Data Laporan - {{ $kelas->jenis_kelas }} {{ $kelas->kelas }} {{ $kelas->kelamin_kelas }}</h5>
    </div>
    <div class="p-6">
        <form id="tambahLaporanForm" action="{{ route('laporan.updateDataBulk') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                <select 
                    name="bulan"    
                    id="bulan" 
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:outline-none focus:border-blue-500" 
                    required>
                    <option value="" disabled selected>Pilih Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                <input 
                    type="number" 
                    name="tahun" 
                    id="tahun" 
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:outline-none focus:border-blue-500" 
                    min="2024" 
                    max="{{ date('Y') }}" 
                    value="2024" 
                    required>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-gray-700 bg-gray-100">
                        <tr>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">NIS</th>
                            <th class="px-6 py-3">Jumlah Hafalan</th>
                            <th class="px-6 py-3">Juz</th>
                            <th class="px-6 py-3">Kondisi Bacaan</th>
                            <th class="px-6 py-3">Keterangan</th>
                            <th class="px-6 py-3">Hafalan Lancar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $index => $s)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $s->nama }}</td>
                            <td class="px-6 py-4">{{ $s->nis }}</td>
                            <td class="px-6 py-4">
                                <input 
                                    type="hidden" 
                                    name="siswa[{{ $index }}][siswa_id]" 
                                    value="{{ $s->id }}">
                                <input 
                                    type="number" 
                                    id="jumlah_hafalan_{{ $index }}" 
                                    name="siswa[{{ $index }}][jumlah_hafalan]" 
                                    class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100">
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" 
                                        class="bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-600 transition duration-200" 
                                        onclick="toggleJuzPopup({{ $index }})">
                                    Pilih Juz
                                </button>
                                <div id="juzPopup_{{ $index }}" class="hidden absolute bg-white border rounded-lg shadow-lg p-4 z-20">
                                    <div class="grid grid-cols-5 gap-1">
                                        @for ($j = 1; $j <= 30; $j++)
                                            <label class="inline-flex items-center">
                                                <input 
                                                    type="checkbox" 
                                                    name="siswa[{{ $index }}][juz][]" 
                                                    value="{{ $j }}"
                                                    class="form-checkbox border-gray-300 rounded focus:ring focus:ring-blue-200"
                                                    onchange="hitungJumlahHafalan({{ $index }})">
                                                <span class="ml-1 text-sm">Juz {{ $j }}</span>
                                            </label>
                                        @endfor
                                    </div>
                                    <button type="button" class="mt-2 text-red-500" onclick="toggleJuzPopup({{ $index }})">Tutup</button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <select 
                                    name="siswa[{{ $index }}][kondisi_bacaan]" 
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:outline-none focus:border-blue-500" 
                                    required>
                                    <option value="A">A</option>
                                    <option value="B+">B+</option>
                                    <option value="B">B</option>
                                    <option value="B-">B-</option>
                                    <option value="C">C</option>
                                </select>
                            </td>
                            <td class="px-6 py-4">
                                <textarea 
                                    name="siswa[{{ $index }}][keterangan]" 
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:outline-none focus:border-blue-500"></textarea>
                            </td>
                            <td class="px-6 py-4">
                                <input 
                                    type="text" 
                                    name="siswa[{{ $index }}][hafalan_lancar]" 
                                    class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" 
                                    value="{{ old('siswa.'.$index.'.hafalan_lancar', $s->hafalan_lancar ?? '') }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="flex justify-end border-t p-4 sticky bottom-0 bg-white z-10">
        <button 
            type="submit" 
            form="tambahLaporanForm" 
            class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Simpan
        </button>
    </div>
</div>

<script>
    // Fungsi untuk menghitung jumlah hafalan berdasarkan checkbox yang dipilih
    function hitungJumlahHafalan(index) {
        const checkboxes = document.querySelectorAll(`input[name="siswa[${index}][juz][]"]:checked`);
        const jumlahHafalanInput = document.getElementById(`jumlah_hafalan_${index}`);
        jumlahHafalanInput.value = checkboxes.length;
    }

    // Tambahkan event listener untuk setiap dropdown Juz
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('select[name^="siswa"][name$="[juz]"]');
        inputs.forEach(input => {
            input.addEventListener('change', function () {
                // Custom logic (e.g., updating related fields)
                console.log(`Juz selected: ${this.value}`);
            });
        });
    });

    // Modifikasi fungsi toggleDropdown yang sudah ada
    function toggleDropdown(index) {
        const menu = document.getElementById(`dropdownMenu_${index}`);
        const button = document.getElementById(`dropdownButton_${index}`);
        
        // Toggle visibility
        menu.classList.toggle('hidden');
        const isExpanded = menu.classList.contains('hidden') ? 'false' : 'true';
        button.setAttribute('aria-expanded', isExpanded);
    }

    // Event listener untuk button
    document.querySelectorAll('[id^="dropdownButton_"]').forEach((button, index) => {
        button.addEventListener('click', () => toggleDropdown(index));
    });

    document.addEventListener('click', function (event) {
        const dropdowns = document.querySelectorAll('[id^="dropdownMenu_"]');
        const buttons = document.querySelectorAll('[id^="dropdownButton_"]');

        dropdowns.forEach((menu, index) => {
            const button = buttons[index];
            if (!menu.contains(event.target) && !button.contains(event.target) && !event.target.closest('.block')) {
                menu.classList.add('hidden');
                button.classList.remove('ring', 'ring-blue-300');
            }
        });
    });

    // Fungsi untuk toggle popup Juz
    function toggleJuzPopup(index) {
        const popup = document.getElementById(`juzPopup_${index}`);
        popup.classList.toggle('hidden');
    }
</script>
@endsection
