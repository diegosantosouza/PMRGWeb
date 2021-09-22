<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_processo')->references('id')->on('processos')->onDelete('cascade');
            $table->string('legislacao');
            $table->string('leis_especiais')->nullable();
            $table->integer('artigo');
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
        Schema::dropIfExists('legislacao');
    }
}
