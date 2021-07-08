<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradavisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradavisitantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('visita_id');
            $table->string('menor_12')->nullable();
            $table->bigInteger('interno_id');
            $table->dateTime('chegada');
            $table->dateTime('saida')->nullable();

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
        Schema::dropIfExists('entradavisitantes');
    }
}
