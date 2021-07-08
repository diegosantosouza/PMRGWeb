<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComportamentoArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comportamento_arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comportamento_id')->references('id')->on('comportamento')->onDelete('CASCADE');
            $table->string('path')->nullable();
            $table->boolean('cover')->nullable();
            $table->softDeletes('deleted_at', 0);

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
        Schema::dropIfExists('comportamento_arquivos');
    }
}
