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
        Schema::create('pilih_asisten', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alamat');
            $table->foreign('id_alamat')->references('id')->on('alamat');
            $table->unsignedBigInteger('id_asisten');
            $table->foreign('id_asisten')->references('id')->on('asistens');
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
        Schema::dropIfExists('pilih_asisten');
    }
};
