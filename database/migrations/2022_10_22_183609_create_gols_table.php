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
        Schema::create('gols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jogos_id');
            $table->unsignedBigInteger('jogadores_id');
            $table->unsignedBigInteger('jogadores_times_id');
            $table->unsignedInteger('quantidade');
            $table->timestamps();

            $table->foreign('jogos_id')->references('id')->on('jogos');
            $table->foreign('jogadores_id')->references('id')->on('jogadores');
            $table->foreign('jogadores_times_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gols');
    }
};
