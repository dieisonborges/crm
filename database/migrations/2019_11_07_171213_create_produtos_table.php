<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');

            //ID do produto da Store Wordpress
            $table->integer('store_id')->unsigned();

            //Produto
            //Back-Up das Informações do Produto do Wordpress
            $table->jsonb('produto');

            //Dados do Armazém/Store Wordpress
            $table->integer('armazem_id')->unsigned();
            $table->foreign('armazem_id')
                    ->references('id')
                    ->on('armazems')
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
        Schema::dropIfExists('produtos');
    }
}
