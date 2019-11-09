<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');

            //ID do produto da Store Wordpress
            $table->integer('product_store_id')->unsigned();

            //Produto
            //Back-Up das Informações do Produto do Wordpress
            $table->jsonb('product');

            //Back-Up das Informações da Venda do Wordpress
            $table->jsonb('order');

            //Dados do Armazém/Store Wordpress
            $table->integer('armazem_id')->unsigned();
            $table->foreign('armazem_id')
                    ->references('id')
                    ->on('armazems')
                    ->onDelete('cascade');

            //Dados do Armazém/Store Wordpress
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')
                    ->references('id')
                    ->on('produtos')
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
        Schema::dropIfExists('vendas');
    }
}
