<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('protocolo')->unique();
            $table->string('titulo');

            $table->integer('status');
            // 1 - Aberto/Ativo
            // 0 - Fechado/Encerrado
           
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->longText('descricao');

            //
            // Rotulos de Criticidade
            // Nenhum           - 4 - Nenhum
            // Baixo            - 3 - Rotina de Manutenção
            // Médio            - 2 - Intermediária (avaliar componente)
            // Alto             - 1 - Urgência (reparar o mais rápido possível)
            // Crítico          - 0 - Emergência (reparar imediatamente) 

            $table->integer('rotulo')->unsigned()->default(0);


            $table->timestamps();
        });

        Schema::create('prontuario_tickets', function (Blueprint $table) {
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

            $table->longText('descricao');
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
        Schema::dropIfExists('prontuario_tickets');
        Schema::dropIfExists('tickets');
        
    }
}
