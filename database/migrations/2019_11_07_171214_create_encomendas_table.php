<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncomendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->increments('id');

            //Quantidade
            $table->double('quantidade', 15, 8);

            //Quantidade Envio Para Comprador
            $table->double('quantidade_envio', 15, 8);

            //Valor em R$
            $table->double('valor', 15, 8);

            //Valor Frete em R$
            $table->double('frete', 15, 8);

            //Quantidade
            //Un - Kg - Lt ...
            $table->string('tipo_quantidade');

            //Usuário que fez a encomenda
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');  

            //Produto Encomendado
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')
                    ->references('id')
                    ->on('produtos')
                    ->onDelete('cascade');

            //Código de Trasação - Status Code
            /*
            >>> 0 - Cancelado.
            >>> 1 - Em análise.
            >>> 2 - Aprovado.
            >>> 3 - Finalizado.
            */
            $table->integer('status')->unsigned()->default(1);

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
        Schema::dropIfExists('encomendas');
    }
}
