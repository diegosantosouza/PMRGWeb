<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComportamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comportamento', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('id_interno')->references('id')->on('internos')->onDelete('cascade');
            $table->string('pdi_status')->nullable();
            $table->longText('assunto')->nullable();
            $table->string('tipo_falta');
            $table->longText('punicao')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_termino')->nullable();

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
        Schema::dropIfExists('comportamento');
    }
}
