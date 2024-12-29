@extends('layouts.navside')

@section('content')
@if(session('success'))
    <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4 flex justify-between items-center">
        <span>{{ session('success') }}</span>
        <button id="close-success-message" class="text-white ml-4">&times;</button>
    </div>
@endif

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Profil Pengguna</h1>
    
    <!-- Tampilkan Foto Profil -->
    <div class="mb-6 flex justify-center">
        <img alt="Foto Profil pengguna dengan latar belakang abu-abu" class="w-32 h-32 rounded-full ring ring-offset-2 ring-primary cursor-pointer" height="128" id="openProfileImageModal" src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('images/default-profile.png') }}" width="128"/>
    </div>

    <form action="{{ route('profile.update') }}" class="space-y-4" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700" for="name">Nama:</label>
            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="name" required="" type="text" value="{{ auth()->user()->name }}"/>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700" for="email">Email:</label>
            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="email" required="" type="email" value="{{ auth()->user()->email }}"/>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700" for="image">Foto Profil:</label>
            <input class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" name="image" type="file"/>
        </div>
        <button class="w-full py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Simpan Perubahan</button>
    </form>

    <form action="{{ route('profile.resetPassword') }}" class="mt-6 space-y-4" method="POST">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700" for="password">Kata Sandi Baru:</label>
            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="password" required="" type="password"/>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700" for="password_confirmation">Konfirmasi Kata Sandi:</label>
            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="password_confirmation" required="" type="password"/>
        </div>
        <button class="w-full py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Reset Kata Sandi</button>
    </form>
</div>

<!-- Modal -->
<div class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300" id="profileImageModal">
    <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-transform duration-300">
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="closeProfileImageModal">
            <svg class="h-5 w-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" d="M10 8.586L4.293 2.879a1 1 0 00-1.414 1.414L8.586 10l-5.707 5.707a1 1 0 001.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" fill-rule="evenodd"></path>
            </svg>
        </button>
        <div class="p-6">
            <img alt="Foto Profil pengguna dengan latar belakang abu-abu" class="w-full rounded-lg shadow-md border border-gray-200" height="400" src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('images/default-profile.png') }}" width="400"/>
        </div>
    </div>
</div>

<script src="{{ asset('js/profile.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        const closeButton = document.getElementById('close-success-message');

        if (successMessage) {
            // Set timer to hide the success message after 5 seconds
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 2000); // 5000 milliseconds = 5 seconds

            // Allow manual closing of the message
            if (closeButton) {
                closeButton.addEventListener('click', function () {
                    successMessage.style.display = 'none';
                });
            }
        }
    });
</script>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
@endsection
