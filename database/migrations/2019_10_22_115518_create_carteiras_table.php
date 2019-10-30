<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteiras', function (Blueprint $table) {
            //Transações Financeiras
            $table->increments('id');
            //Codigo da Transação
            $table->string('codigo');
            $table->mediumText('descricao');
            //Valor da Transação
            $table->double('valor', 15, 8);
            //Saldo Atualizado
            $table->double('saldo', 15, 8);
            //Dolar no momento da Transacao
            $table->double('dolar', 15, 8);
            //VET no momento da transacao
            $table->double('vet', 15, 8);

            //Código de Trasação - Status Code
            /*
            >>> 0 - Nova: Cobrança gerada, aguardando definição da forma de pagamento.
            >>> 1 - Aguardando pagamento: o comprador iniciou a transação, sem nenhuma informação sobre o pagamento.
            >>> 2 -  Em análise: o comprador optou por pagar com um cartão de crédito e está sendo analisado o risco da transação.
            >>> 3 - Paga: a transação foi paga pelo comprador e já foi recebida uma confirmação da instituição financeira responsável pelo processamento.
            >>> 4 - Disponível: a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
            >>> 5 - Em disputa: o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
            >>> 6 - Devolvida: o valor da transação foi devolvido para o comprador.
            >>> 7 - Cancelada: a transação foi cancelada sem ter sido finalizada.
            */

            $table->integer('status')->unsigned()->default(0);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->timestamps();
        });


        Schema::create('carteira_ticket', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('carteira_id')->unsigned();
            $table->foreign('carteira_id')
                    ->references('id')
                    ->on('carteiras')
                    ->onDelete('cascade');

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

        Schema::dropIfExists('carteira_ticket');

        Schema::dropIfExists('carteiras');
    }
}
