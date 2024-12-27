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
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->integer('juz');
            $table->string('surah');
            $table->integer('ayat_awal');
            $table->integer('ayat_akhir');
            $table->enum('bacaan', ['lancar', 'cukup', 'kurang']);
            $table->enum('status', ['murajaah', 'hafalan','ujian']);
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->timestamps();
    
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hafalan');
    }
};
