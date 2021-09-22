<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_interno')->references('id')->on('internos')->onDelete('cascade');

            $table->string('em_servico');
            $table->string('processo_de_execucao')->nullable();
            $table->string('regime');
            $table->string('n_inquerito')->nullable();
            $table->string('multa')->nullable();
            $table->string('sit_processual');
            $table->string('reincidencia');

            $table->integer('pena_ano')->nullable();
            $table->integer('pena_meses')->nullable();
            $table->integer('pena_dias')->nullable();

            $table->string('medida_tratamento')->nullable();
            $table->string('comutacao')->nullable();
            $table->string('transito_julgado')->nullable();
            $table->string('exticao_punibilidade')->nullable();
            $table->string('origem_processo');
            $table->string('cpb_cpm');
            $table->integer('artigo');

            $table->string('vara_comarca');

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
        Schema::dropIfExists('processos');
    }
}
