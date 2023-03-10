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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_cotizacion');
            $table->float('m2');
            $table->string('condiciones');
            $table->string('acabados');
            $table->integer('recamaras');
            $table->float('baños');
            $table->integer('cocheras');
            $table->integer('cuartos_servicio');
            $table->integer('cuarto_lavado');
            $table->integer('estudio');
            $table->integer('sala_tv');
            $table->integer('vestidor');
            $table->integer('portico');
            $table->string('otro');
            $table->float('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
};
