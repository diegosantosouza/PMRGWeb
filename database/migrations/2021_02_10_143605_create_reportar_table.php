<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportar', function (Blueprint $table) {
            $table->id();
            $table->string('user_nome');
            $table->string('user_email');
            $table->string('erro');
            $table->longText('descricao')->nullable();
            $table->string('user_dev')->nullable();
            $table->string('user_dev_email')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('reportar');
    }
}
