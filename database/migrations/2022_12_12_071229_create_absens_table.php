<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_id')->nullable();
            $table->integer('jadwal_id')->nullable();
            $table->text('status')->nullable();
            $table->integer('pertemuan')->nullable();
            $table->integer('guru_id')->nullable();
            $table->string('semester', 15)->nullable();
            $table->integer('kelas_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tahun_ajaran', 15)->nullable();
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
        Schema::dropIfExists('absens');
    }
}
