<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');            
            $table->string('phone_number');
            $table->string('cpf')->nullable()->unique();
            $table->string('country');
            //Quantidade de tentativas de login
            $table->integer('status')->unsigned()->default(0);
            //Status Ativo ou Desativado 0 ou 1
            $table->boolean('login')->unsigned()->default(0);
            
            $table->rememberToken();

            $table->timestamps();
            
            $table->string('apelido');
            //Quantidade de Convites do usuário
            //Para Criação de franquias
            $table->integer('qtd_convites')->unsigned()->nullable()->default(0);
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
