<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persons');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_temporada');
     
            $table->foreign('id_persons')->references('id')->on('persons');
            $table->foreign('id_categoria')->references('id')->on('categories');
            $table->foreign('id_temporada')->references('id')->on('temporada');
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
        Schema::dropIfExists('inscripcion');
    }
}

