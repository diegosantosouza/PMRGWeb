<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internos', function (Blueprint $table) {
            $table->id();

            $table->string('nome_completo');
            $table->string('foto')->nullable();
            $table->string('sexo');
            $table->string('orientacao_sexual');
            $table->string('rg');
            $table->string('org_expedidor')->nullable();
            $table->bigInteger('cpf')->unique();
            $table->bigInteger('titulo_eleitor')->nullable();
            $table->integer('zona')->nullable();
            $table->integer('secao')->nullable();
            $table->string('nacionalidade');
            $table->string('natural');
            $table->string('estado');
            $table->date('nascimento');
            $table->integer('idade');
            $table->string('estado_civil');
            $table->string('conjugue')->nullable();
            $table->string('procedencia')->nullable();
            $table->string('captura_procurado')->nullable();
            $table->string('captura_estado')->nullable();
            $table->string('tipo_prisao')->nullable();
            $table->string('assistencia_juridica')->nullable();
            $table->string('pai')->nullable();
            $table->string('mae')->nullable();
            $table->string('escolaridade');
            $table->string('religiao')->nullable();
            $table->string('etnia')->nullable();
            $table->string('cabelos')->nullable();
            $table->string('olhos')->nullable();
            $table->integer('altura')->nullable();
            $table->integer('peso')->nullable();
            $table->string('defeitos_fisicos')->nullable();
            $table->string('sinais_nascenca')->nullable();
            $table->string('cicatrizes')->nullable();
            $table->string('tatuagens')->nullable();


            $table->string('endereco')->nullable();
            $table->string('cidade')->nullable();
            $table->bigInteger('telefone')->nullable();
            $table->string('acidente_doenca_morte')->nullable();


            $table->string('nome_guerra')->nullable();
            $table->bigInteger('re')->unique()->nullable();
            $table->bigInteger('funcional')->nullable();
            $table->string('patente')->nullable();
            $table->string('situacao')->nullable();
            $table->string('batalhao')->nullable();
            $table->string('batalhao_cidade')->nullable();
            $table->date('admissao')->nullable();
            $table->date('demissao')->nullable();

            $table->integer('n')->unique()->nullable();
            $table->string('alojamento');
            $table->integer('estagio');
            $table->string('status');
            $table->date('data_liberdade_remocao')->nullable();
            $table->string('local')->nullable();
            $table->string('sit_anterior_prisao')->nullable();



            $table->longText('observacoes')->nullable();
            $table->bigInteger('estudo')->nullable();
            $table->bigInteger('empregador')->nullable();
            $table->string('comportamento_status')->nullable();
            $table->date('comportamento_data')->nullable();

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
        Schema::dropIfExists('internos');
    }
}
