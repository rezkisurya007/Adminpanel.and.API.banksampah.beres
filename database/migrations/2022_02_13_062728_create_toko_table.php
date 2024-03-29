<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id('id_toko');
            $table->string('id_kecamatan_toko');
            $table->string('nama_toko');
            $table->string('alamat_toko');
            $table->biginteger('saldo_toko');
            $table->string('pin_toko');
            $table->biginteger('no_hp_toko');
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
        Schema::dropIfExists('toko');
    }
};
