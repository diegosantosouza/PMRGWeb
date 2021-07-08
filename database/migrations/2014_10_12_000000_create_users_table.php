<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('re')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('ativo')->nullable();
            $table->integer('admin')->nullable();
            $table->string('foto')->nullable();
            $table->integer('penal')->nullable();
            $table->integer('labor')->nullable();
            $table->integer('juridica')->nullable();
            $table->integer('pjmd')->nullable();
            $table->integer('escolta')->nullable();
            $table->integer('guarda')->nullable();
            $table->integer('naps')->nullable();
            $table->integer('uis')->nullable();
            $table->integer('uge')->nullable();
            $table->integer('p1')->nullable();
            $table->integer('p2')->nullable();
            $table->integer('p4')->nullable();
            $table->integer('p5')->nullable();
            $table->string('secao')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
