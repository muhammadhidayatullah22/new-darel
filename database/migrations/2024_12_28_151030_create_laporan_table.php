<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade'); // Relasi ke siswa
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade'); // Relasi ke kelas
            $table->integer('jumlah_hafalan')->nullable();
            $table->text('juz')->nullable();
            $table->enum('kondisi_bacaan', ['A', 'B+', 'B', 'B-', 'C'])->nullable();
            $table->text('hafalan_lancar')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
