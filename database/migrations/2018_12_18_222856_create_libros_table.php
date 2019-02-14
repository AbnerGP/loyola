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
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');//->unique();
            $table->longText('descripcion');
            $table->string('ubicacion')->nullable();
            $table->longText('keywords');
            $table->string('autor');
            $table->string('num_edicion')->nullable();
            $table->string('lugar_edicion')->nullable();
            $table->string('coleccion')->nullable();
            $table->string('editorial')->nullable();
            $table->string('num_libro')->nullable();
            $table->string('year')->nullable();
            $table->string('tema')->nullable();
            $table->softDeletes();
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
