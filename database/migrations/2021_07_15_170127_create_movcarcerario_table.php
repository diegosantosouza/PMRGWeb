<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovcarcerarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movcarcerario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_interno')->references('id')->on('internos')->onDelete('cascade');
            $table->string('celaanterior');
            $table->integer('estagioanterior');
            $table->string('celaatual');
            $table->integer('estagioatual');
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
        Schema::dropIfExists('movcarcerario');
    }
}
