<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->integer('kelas_id')->nullable();
            $table->integer('ruangan_id')->nullable();
            $table->integer('guru_id')->nullable();
            $table->integer('mata_pelajaran_id')->nullable();
            $table->string('hari_id', 10)->nullable();
            $table->string('jam_masuk', 10)->nullable();
            $table->string('jam_keluar', 10)->nullable();
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
        Schema::dropIfExists('jadwals');
    }
}
