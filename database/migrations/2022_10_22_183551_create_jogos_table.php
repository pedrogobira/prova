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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->time('hora_de_inicio');
            $table->time('hora_de_termino');
            $table->unsignedBigInteger('primeiro_time_id');
            $table->unsignedBigInteger('segundo_time_id');
            $table->timestamps();

            $table->foreign('primeiro_time_id')->references('id')->on('times');
            $table->foreign('segundo_time_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogos');
    }
};
