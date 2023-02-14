<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('email')->nullable();
            $table->string('nama_siswa')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nama_bapak')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_bapak')->nullable();
            $table->string('penghasilan_bapak')->nullable();
            $table->string('agama_bapak')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('no_telp_bapak')->nullable();
            $table->string('no_telp_ibu')->nullable();
            $table->string('email_bapak')->nullable();
            $table->string('email_ibu')->nullable();
            $table->string('tgl_daftar')->nullable();
            $table->string('jurusan_1')->nullable();
            $table->string('jurusan_2')->nullable();
            $table->string('prestasi_1')->nullable();
            $table->string('prestasi_2')->nullable();
            $table->string('ijasah')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pendaftarans');
    }
}
