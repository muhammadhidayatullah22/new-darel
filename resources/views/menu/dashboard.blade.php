@extends('layouts.navside')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modernisasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-roboto">
    <section class="text-gray-800 body-font">
        <div class="w-full mx-auto px-5 py-24">
            <!-- Statistik Pengguna Terdaftar dan Berita dari Eramuslim -->
            <div class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                    <h2 class="text-lg font-bold mb-4">Statistik Pengguna</h2>
                    <p class="text-gray-900">Jumlah Pengguna Terdaftar: <span class="text-blue-700"></span></p>
                    <p class="text-lg font-bold mb-4 text-red-700">Jika Melihat Keanehan Dalam Pengguna Terdaftar Mohon Laporkan</p>
                </div>
                <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                    <h2 class="text-lg font-bold mb-4">Berita Terbaru dari Darel Hikmah Pekanbaru</h2>
                    <iframe src="https://www.ppdh.sch.id//" width="100%" height="400" frameborder="0" class="rounded-lg shadow-lg"></iframe>
                </div>
            </div>
            <!-- Grafik -->
            <div class="mb-10">
                <h2 class="text-lg font-bold mb-4">Grafik Perkembangan Hafalan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900">Perkembangan Hafalan Siswa</h3>
                        <canvas id="hafalanSiswaChart"></canvas>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900">Perkembangan Setoran Hafalan Bulan Ini</h3>
                        <canvas id="setoranBulanChart"></canvas>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900">Setoran Hafalan Tahunan</h3>
                        <canvas id="setoranTahunChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Kalender Hari Besar Islam -->
            <div class="mb-10">
                <h2 class="text-lg font-bold mb-4">Kalender Hari Besar Islam</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900">Senin, 27 Januari 2025</h3>
                        <p class="text-gray-900">Libur Isra Mikraj Nabi Muhammad SAW</p>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900">Senin, 31 Maret 2025</h3>
                        <p class="text-gray-900">Libur Idul Fitri 1446 Hijriah</p>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900">Selasa, 1 April 2025</h3>
                        <p class="text-gray-900">Libur Idul Fitri 1446 Hijriah</p>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900">Jumat, 6 Juni 2025</h3>
                        <p class="text-gray-900">Libur Idul Adha 1446 Hijriah</p>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900">Jumat, 27 Juni 2025</h3>
                        <p class="text-gray-900">Libur 1 Muharam Tahun Baru Islam 1447 Hijriah</p>
                    </div>
                    <div class="bg-[#BFD8AF] p-6 rounded-lg shadow-lg card">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900">Jumat, 5 September 2025</h3>
                        <p class="text-gray-900">Libur Maulid Nabi Muhammad SAW</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Perkembangan Hafalan Siswa Chart
        const ctx1 = document.getElementById('hafalanSiswaChart').getContext('2d');
        const hafalanSiswaChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Hafalan Siswa',
                    data: [12, 19, 3, 5, 2, 3, 10, 15, 20, 25, 30, 35],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Perkembangan Setoran Hafalan Bulan Ini Chart
        const ctx2 = document.getElementById('setoranBulanChart').getContext('2d');
        const setoranBulanChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Setoran Hafalan Bulan Ini',
                    data: [5, 10, 15, 20],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Setoran Hafalan Tahunan Chart
        const ctx3 = document.getElementById('setoranTahunChart').getContext('2d');
        const setoranTahunChart = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                datasets: [{
                    label: 'Setoran Hafalan Tahunan',
                    data: [30, 40, 20, 10],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Update current time
        function updateTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('currentTime').textContent = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>
@endsection