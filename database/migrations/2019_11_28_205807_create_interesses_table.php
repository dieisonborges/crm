<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesses', function (Blueprint $table) {
            $table->bigIncrements('id');

            //ID do produto da Store Wordpress
            $table->integer('store_id')->unsigned();

            //Dados do Armazém/Store Wordpress
            $table->integer('armazem_id')->unsigned();
            $table->foreign('armazem_id')
                    ->references('id')
                    ->on('armazems')
                    ->onDelete('cascade');

            //Usuário que manifestou interesse
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');  

            //Resumo do interesse
            $table->string('resumo');

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
        Schema::dropIfExists('interesses');
    }
}
