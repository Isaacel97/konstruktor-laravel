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
        Schema::create('rel_acabados_condiciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condicion_id');
            $table->unsignedBigInteger('acadado_id');
            $table->foreign('condicion_id')->references('id')->on('condiciones');
            $table->foreign('acadado_id')->references('id')->on('acabados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_acabados_condiciones');
    }
};
