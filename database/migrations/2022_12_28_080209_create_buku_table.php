<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku',150);
            $table->string('isbn_no',50);
            $table->string('penerbit',120);
            $table->string('penulis',120);
            $table->string('rak',50);
            $table->integer('jumlah');
            $table->integer('kategori_id');
            $table->integer('dibuat_oleh');
            $table->integer('diubah_oleh');
            $table->double('harga', 15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
