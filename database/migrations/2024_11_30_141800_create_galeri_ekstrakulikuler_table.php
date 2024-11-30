<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriEkstrakulikulerTable extends Migration
{
    public function up()
    {
        Schema::create('galeri_ekstrakulikuler', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ekstrakulikuler_id');
            $table->string('path');
            $table->timestamps();

            // Menambahkan foreign key constraint untuk referensi ke tabel ekstrakulikuler
            $table->foreign('ekstrakulikuler_id')->references('id')->on('ekstrakulikuler')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeri_ekstrakulikuler');
    }
}
