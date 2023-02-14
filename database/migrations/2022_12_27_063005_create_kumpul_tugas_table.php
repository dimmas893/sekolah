<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKumpulTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kumpul_tugas', function (Blueprint $table) {
            $table->id();
            $table->integer('tugas_id');
            $table->integer('siswa_id');
            $table->date('tanggal_evaluasi');
            $table->string('file_upload', 100);
            $table->integer('dibuat_oleh');
            $table->integer('diubah_oleh');
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
        Schema::dropIfExists('kumpul_tugas');
    }
}
