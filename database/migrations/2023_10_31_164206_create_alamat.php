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
        Schema::create('alamat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penyewa');
            $table->foreign('id_penyewa')->references('id')->on('users');
            $table->string('nama_alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->smallInteger('kode_pos');
            $table->string('alamat_lengkap');
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
        Schema::dropIfExists('alamat');
    }
};
