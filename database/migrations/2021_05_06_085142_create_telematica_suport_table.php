<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelematicaSuportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telematica_suport', function (Blueprint $table) {
            $table->id();
            $table->string('solicitante_nome');
            $table->string('solicitante_re');
            $table->string('ip')->nullable();
            $table->string('solicitante_secao');
            $table->string('descricao');

            $table->string('suporte_nome')->nullable();
            $table->string('suporte_re')->nullable();
            $table->string('solucao')->nullable();
            $table->integer('classificacao')->nullable();
            $table->integer('finalizado')->nullable();

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
        Schema::dropIfExists('telematica_suport');
    }
}
