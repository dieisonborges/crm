<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('id');

            // 0 - Em edição
            // 1 - Bloqueado (Enviado Para Cotação)
            // 2 - Cancelado
            // 3 - Cotação Finalizada
            $table->string('status')->default('0');

            $table->date('validade')->nullable();
            $table->string('codigo')->unique();
            $table->longText('token');
            $table->date('token_validade');

            $table->integer('fornecedor_id')->unsigned()->nullable();
            $table->foreign('fornecedor_id')
                    ->references('id')
                    ->on('fornecedors')
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
        Schema::dropIfExists('orcamentos');
    }
}
