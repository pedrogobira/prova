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
        Schema::create('placares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jogos_id');
            $table->unsignedBigInteger('jogos_primeiro_time_id');
            $table->unsignedBigInteger('jogos_segundo_time_id');
            $table->unsignedInteger('gols_primeiro_time');
            $table->unsignedInteger('gols_segundo_time');
            $table->unsignedBigInteger('vencedor_id');
            $table->timestamps();

            $table->foreign('jogos_id')->references('id')->on('jogos');
            $table->foreign('jogos_primeiro_time_id')->references('id')->on('times');
            $table->foreign('jogos_segundo_time_id')->references('id')->on('times');
            $table->foreign('vencedor_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('placares');
    }
};
