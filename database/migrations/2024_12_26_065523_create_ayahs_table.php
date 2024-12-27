<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyahsTable extends Migration
{
    public function up()
    {
        Schema::create('ayahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surah_id'); // Foreign key ke surahs
            $table->integer('number'); // Nomor Ayah
            $table->text('text'); // Teks Ayah (Arab)
            $table->integer('number_in_surah'); // Nomor Ayah dalam Surah
            $table->integer('juz'); // Juz ayat
            $table->timestamps();

            $table->foreign('surah_id')->references('id')->on('surahs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ayahs');
    }
}
