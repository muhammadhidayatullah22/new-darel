<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurahsTable extends Migration
{
    public function up()
    {
        Schema::create('surahs', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique(); // Nomor Surah
            $table->string('name'); // Nama Surah
            $table->string('english_name'); // Nama dalam Bahasa Inggris
            $table->string('english_name_translation'); // Terjemahan
            $table->string('revelation_type'); // Tipe Wahyu (Mekah/Madinah)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surahs');
    }
}
