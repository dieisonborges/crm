<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConquistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conquistas', function (Blueprint $table) {
            $table->increments('id');
            //Titulo da conquista
            $table->string('titulo');
            //Valor a ser acrescentado no Score
            $table->integer('valor_score');
            //Descrição e motivo que alguém atinge esta conquista
            $table->mediumText('descricao');
            //Nome para carregar a imagem da medalha
            $table->string('imagem_medalha');
            //Nome para carregar a icone da medalha (fa fa-icon)
            $table->string('icone_medalha');

            $table->timestamps();
        });

        Schema::create('conquista_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conquista_id')->unsigned();
            

            $table->foreign('conquista_id')
                    ->references('id')
                    ->on('conquistas')
                    ->onDelete('cascade');

            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');  

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
        Schema::dropIfExists('conquista_user');
        Schema::dropIfExists('conquistas');
    }
}
