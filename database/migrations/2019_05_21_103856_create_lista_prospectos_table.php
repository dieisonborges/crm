<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaProspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_prospectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });

        //Franquia do Prospecto
        Schema::create('lista_prospecto_franquia', function (Blueprint $table) {
            $table->increments('id'); 

            //Franquia
            $table->integer('franquia_id')->unsigned()->nullable();
            $table->foreign('franquia_id')
                    ->references('id')
                    ->on('franquias')
                    ->onDelete('cascade');            

            //Produto
            $table->integer('lista_prospecto_id')->unsigned();
            $table->foreign('lista_prospecto_id')
                    ->references('id')
                    ->on('lista_prospectos')
                    ->onDelete('cascade');

            $table->timestamps();
        });

        //Produto Lista Prospecto
        Schema::create('lista_prospecto_produto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lista_prospecto_id')->unsigned();            

            $table->foreign('lista_prospecto_id')
                    ->references('id')
                    ->on('lista_prospectos')
                    ->onDelete('cascade');

            $table->integer('produto_id')->unsigned();

            $table->foreign('produto_id')
                    ->references('id')
                    ->on('produtos')
                    ->onDelete('cascade');  

            $table->timestamps();
        });

        //Categorias de Interesse do Prospecto
        Schema::create('lista_prospecto_categoria', function (Blueprint $table) {
            $table->increments('id'); 

            //Franquia
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
                    ->onDelete('cascade');            

            //Produto
            $table->integer('lista_prospecto_id')->unsigned();
            $table->foreign('lista_prospecto_id')
                    ->references('id')
                    ->on('lista_prospectos')
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
        Schema::dropIfExists('lista_prospecto_categoria');
        Schema::dropIfExists('lista_prospecto_produto');
        Schema::dropIfExists('lista_prospecto_franquia');
        Schema::dropIfExists('lista_prospectos');
    }
}
