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
        Schema::create('cartoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jogadores_id');
            $table->unsignedBigInteger('jogadores_times_id');
            $table->unsignedBigInteger('jogos_id');
            $table->char('cor');
            $table->timestamps();

            $table->foreign('jogadores_id')->references('id')->on('jogadores');
            $table->foreign('jogadores_times_id')->references('id')->on('times');
            $table->foreign('jogos_id')->references('id')->on('jogos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartoes');
    }
};
