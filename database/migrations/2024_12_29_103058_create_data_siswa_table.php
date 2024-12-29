<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->string('bulan'); // Menyimpan bulan
            $table->integer('tahun'); // Menyimpan tahun
            $table->integer('jumlah_hafalan')->nullable(); // Menyimpan jumlah hafalan per bulan
            $table->string('juz')->nullable(); // Menyimpan informasi Juz
            $table->enum('kondisi_bacaan', ['A', 'B+', 'B', 'B-', 'C'])->nullable();
            $table->string('keterangan')->nullable(); // Menyimpan keterangan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};