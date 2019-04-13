<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_orcamentos', function (Blueprint $table) {

            $table->increments('id');

            $table->string('quantidade');

            $table->string('unidade_medida');

            $table->double('preco', 8, 2);

            $table->double('frete_preco', 8, 2);

            $table->string('frete_tipo');

            //Orçamento
            $table->integer('orcamento_id')->unsigned();
            $table->foreign('orcamento_id')
                    ->references('id')
                    ->on('orcamentos')
                    ->onDelete('cascade');

            //Produto
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
        Schema::dropIfExists('item_orcamentos');
    }
}
