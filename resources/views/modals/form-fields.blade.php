@php
    $isEdit = $isEdit ?? false; // Default ke false jika $isEdit tidak tersedia
@endphp

<form method="POST" action="{{ route('hafalan.store') }}">
    @csrf
    <div class="form-container">
        <div class="form-left">
            <!-- Field Tanggal -->
            <div class="mb-4">
                <label for="{{ $isEdit ? 'editTanggal' : 'tanggal' }}" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="{{ $isEdit ? 'editTanggal' : 'tanggal' }}" name="tanggal" class="form-input mt-1" required>
            </div>

            <!-- Field Surah -->
            <div class="mb-4">
                <label for="{{ $isEdit ? 'editSurah' : 'surah' }}" class="block text-sm font-medium text-gray-700">Surah</label>
                <select id="{{ $isEdit ? 'editSurah' : 'surah' }}" name="surah" class="form-select mt-1" required>
                    @foreach($surah as $s)
                        <option value="{{ $s->id }}" data-name="{{ $s->name }}" data-number-of-verses="{{ $s->total_ayahs }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="surah_name" id="surah_name" value="">
            </div>

            <!-- Field Ayat -->
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="{{ $isEdit ? 'editAyatAwal' : 'ayat_awal' }}" class="block text-sm font-medium text-gray-700">Ayat Awal</label>
                    <select id="{{ $isEdit ? 'editAyatAwal' : 'ayat_awal' }}" name="ayat_awal" class="form-select mt-1" required>
                        <!-- Opsi akan diisi oleh JavaScript -->
                    </select>
                </div>
                <div>
                    <label for="{{ $isEdit ? 'editAyatAkhir' : 'ayat_akhir' }}" class="block text-sm font-medium text-gray-700">Ayat Akhir</label>
                    <select id="{{ $isEdit ? 'editAyatAkhir' : 'ayat_akhir' }}" name="ayat_akhir" class="form-select mt-1" required>
                        <!-- Opsi akan diisi oleh JavaScript -->
                    </select>
                </div>
            </div>

            <!-- Field Juz -->
            <div class="mb-4">
                <label for="{{ $isEdit ? 'editJuz' : 'juz' }}" class="block text-sm font-medium text-gray-700">Juz</label>
                <select id="{{ $isEdit ? 'editJuz' : 'juz' }}" name="juz" class="form-select mt-1" required>
                    @foreach($juz as $j)
                        <option value="{{ $j }}">{{ $j }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-right">
            <!-- Field Bacaan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Bacaan</label>
                <div class="flex space-x-2">
                    <button type="button" class="button-bacaan" data-value="lancar">Lancar</button>
                    <button type="button" class="button-bacaan" data-value="cukup">Cukup</button>
                    <button type="button" class="button-bacaan" data-value="kurang">Kurang</button>
                </div>
                <input type="hidden" name="bacaan" id="bacaan" value="lancar">
            </div>

            <!-- Field Status -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <div class="flex space-x-2">
                    <button type="button" class="button-status" data-value="murajaah">Murajaah</button>
                    <button type="button" class="button-status" data-value="hafalan">Hafalan</button>
                    <button type="button" class="button-status" data-value="ujian">Ujian</button>
                </div>
                <input type="hidden" name="status" id="status" value="murajaah">
            </div>

            <!-- Field Keterangan -->
            <div class="mb-4">
                <label for="{{ $isEdit ? 'editKeterangan' : 'keterangan' }}" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea id="{{ $isEdit ? 'editKeterangan' : 'keterangan' }}" name="keterangan" class="form-textarea mt-2"></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-2">
                @if($isEdit)
                    <button type="button" class="btn btn-cancel" @click="openEditModal = false">Tutup</button>
                @else
                    <button type="button" class="btn btn-cancel" @click="openModal = false">Tutup</button>
                @endif
                @if($isEdit)
                    <button type="submit" class="btn btn-save">Update</button>
                @else
                    <button type="submit" class="btn btn-save">Simpan</button>
                @endif
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const surahSelectId = @json($isEdit ? 'editSurah' : 'surah');
        const ayatAwalSelectId = @json($isEdit ? 'editAyatAwal' : 'ayat_awal');
        const ayatAkhirSelectId = @json($isEdit ? 'editAyatAkhir' : 'ayat_akhir');

        const surahSelect = document.getElementById(surahSelectId);
        const ayatAwalSelect = document.getElementById(ayatAwalSelectId);
        const ayatAkhirSelect = document.getElementById(ayatAkhirSelectId);

        function updateAyatOptions() {
            const surahId = surahSelect.value; // Ambil ID surah yang dipilih
            fetch(`/get-ayat-by-surah/${surahId}`)
                .then(response => response.json())
                .then(data => {
                    ayatAwalSelect.innerHTML = '';
                    ayatAkhirSelect.innerHTML = '';

                    data.forEach(ayah => {
                        const option = document.createElement('option');
                        option.value = ayah.number_in_surah;
                        option.textContent = ayah.number_in_surah;
                        ayatAwalSelect.appendChild(option);
                        ayatAkhirSelect.appendChild(option.cloneNode(true)); // Menambahkan opsi yang sama untuk ayat akhir
                    });

                    // Tambahkan event listener untuk ayat awal
                    ayatAwalSelect.addEventListener('change', function() {
                        const ayatAwalValue = parseInt(this.value);
                        const ayatAkhirOptions = Array.from(ayatAkhirSelect.options);
                        ayatAkhirOptions.forEach(option => {
                            option.disabled = parseInt(option.value) < ayatAwalValue; // Nonaktifkan opsi yang kurang dari ayat awal
                        });
                    });
                });
        }

        // Update options saat halaman dimuat
        if (surahSelect) {
            updateAyatOptions();
            surahSelect.addEventListener('change', updateAyatOptions);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Update nilai input hidden berdasarkan tombol yang diklik
        document.querySelectorAll('.button-bacaan').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('bacaan').value = this.dataset.value;
            });
        });

        document.querySelectorAll('.button-status').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('status').value = this.dataset.value;
            });
        });
    });

    surahSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('surah_name').value = selectedOption.dataset.name; // Ambil nama surah
    });
</script>