<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibroUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('libro__users');
        Schema::create('libro__users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('libro_id');
            $table->unsignedInteger('user_id');
            $table->foreign('libro_id')->references('id')->on('libros');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('fecha_prestamo')->nullable();
            $table->dateTime('fecha_devolucion')->nullable();
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
        Schema::dropIfExists('libro__users');
    }
}
