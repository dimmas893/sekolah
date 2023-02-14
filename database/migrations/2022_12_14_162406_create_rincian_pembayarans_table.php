<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembayaran');
            $table->string('id_invoice');
            $table->string('tanggal_pembayaran');
            $table->string('nominal_pembayaran');
            $table->string('metode_pembayaran');
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
        Schema::dropIfExists('rincian_pembayarans');
    }
}
