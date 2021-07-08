<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_interno')->references('id')->on('internos')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->string('nome');
            $table->string('sexo');
            $table->string('parentesco');
            $table->string('documento');
            $table->string('tipo_doc');
            $table->date('dt_nascimento')->nullable();
            $table->string('naturalidade');
            $table->string('uf');
            $table->string('nacionalidade');
            $table->string('pai')->nullable();
            $table->string('mae')->nullable();
            $table->string('endereco')->nullable();
            $table->string('cidade')->nullable();
            $table->string('cep')->nullable();
            $table->string('celular')->nullable();
            $table->string('status');
            $table->string('antecedentes')->nullable();
            $table->string('autorizacao_judicial')->nullable();
            $table->string('autorizacao_menor')->nullable();

            $table->string('placa')->nullable();
            $table->string('modelo')->nullable();

            $table->longText('observacoes')->nullable();


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
        Schema::dropIfExists('visitas');
    }
}
