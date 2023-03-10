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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono')->unique();
            $table->unsignedBigInteger('origen_id');
            $table->unsignedBigInteger('status');
            $table->foreign('origen_id')->references('id')->on('origens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos');
    }
};
