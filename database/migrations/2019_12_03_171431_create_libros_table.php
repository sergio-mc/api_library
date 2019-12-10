<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('libros');
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',200)->nullable();
            $table->string('sinopsis');
            $table->string('genero');
            $table->string('autor');
            $table->boolean('disponible');
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
        Schema::dropIfExists('libros');
    }
}
