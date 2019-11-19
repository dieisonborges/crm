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

            //Valor em R$
            $table->double('valor', 15, 8);

            //Valor Frete em R$
            $table->double('frete', 15, 8);

            //Quantidade
            $table->double('quantidade', 15, 8);

            //Quantidade
            //Un - Kg - Lt ...
            $table->string('tipo_quantidade');

            //Produto
            //Back-Up das Informações do Produto do Wordpress
            $table->jsonb('product');

            //Back-Up das Informações da Venda do Wordpress
            $table->jsonb('order');

            //Usuário que fez a compra
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade'); 

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

            //Ticket de Acompanhamento
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
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
