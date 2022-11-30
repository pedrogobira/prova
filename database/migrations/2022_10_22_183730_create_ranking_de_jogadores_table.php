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
        Schema::create('ranking_de_jogadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jogadores_id');
            $table->unsignedInteger('gols');
            $table->unsignedInteger('pontuacao_dos_cartoes');
            $table->timestamps();

            $table->foreign('jogadores_id')->references('id')->on('jogadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranking_de_jogadores');
    }
};
