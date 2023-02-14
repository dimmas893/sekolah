<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->integer('jadwal_id');
            $table->string('nama', 170);
            $table->date('tanggal_tugas');
            $table->date('tanggal_pengumpulan');
            $table->date('tanggal_evaluasi');
            $table->text('deskripsi');
            $table->integer('status_aktif');
            $table->integer('evaluasi_oleh');
            $table->integer('dibuat_oleh');
            $table->string('file_tugas', 100);
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
        Schema::dropIfExists('tugas');
    }
}
