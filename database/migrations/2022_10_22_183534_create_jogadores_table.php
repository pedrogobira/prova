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
        Schema::create('jogadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->string('cpf', 11)->unique();
            $table->integer('numero');
            $table->unsignedBigInteger('times_id');
            $table->timestamps();

            $table->foreign('times_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogadores');
    }
};
