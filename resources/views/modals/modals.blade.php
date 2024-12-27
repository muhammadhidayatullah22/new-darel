<!-- Modal Tambah -->
<div x-show="openModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-3xl" @click.away="openModal = false">
        <form action="{{ route('hafalan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
            @include('modals.form-fields')
        </form>
    </div>
</div>

<!-- Modal Edit -->
@if(isset($item))
    <div x-show="openEditModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-3xl" @click.away="openEditModal = false">
            <form id="editHafalanForm" action="{{ route('hafalan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('modals.form-fields', ['isEdit' => true])
            </form>
        </div>
    </div>
@else
    <p>Data tidak ditemukan.</p>
@endif
