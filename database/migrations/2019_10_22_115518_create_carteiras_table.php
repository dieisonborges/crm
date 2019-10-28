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
            $table->bigIncrements('id');
            $table->mediumText('descricao');
            //Valor da Transação
            $table->double('valor', 15, 8);
            //Saldo Atualizado
            $table->double('saldo', 15, 8);
            //Dolar no momento da Transacao
            $table->double('dolar', 15, 8);
            //VET no momento da transacao
            $table->double('vet', 15, 8);

            //Confirmação da Transação
            // 1 = Sim
            // 0 = Não
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

            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
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

        Schema::dropIfExists('carteira_ticket');

        Schema::dropIfExists('carteiras');
    }
}
