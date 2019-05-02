<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoPrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_precos', function (Blueprint $table) {

            $table->increments('id'); 

            // 0 - Bloqueado para venda
            // 1 - Liberado para venda
            $table->string('status')->default('0');

            //Fornecedor
            $table->integer('fornecedor_id')->unsigned()->nullable();
            $table->foreign('fornecedor_id')
                    ->references('id')
                    ->on('fornecedors')
                    ->onDelete('cascade');

            //Orçamento
            $table->integer('orcamento_id')->unsigned()->nullable();
            $table->foreign('orcamento_id')
                    ->references('id')
                    ->on('orcamentos')
                    ->onDelete('cascade');

            //ITEM Orçamento
            $table->integer('item_orcamento_id')->unsigned()->nullable();
            $table->foreign('item_orcamento_id')
                    ->references('id')
                    ->on('item_orcamentos')
                    ->onDelete('cascade');

            //Produto
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')
                    ->references('id')
                    ->on('produtos')
                    ->onDelete('cascade');

            //Quantidade em estoque
            $table->string('quantidade');

            $table->string('unidade_medida');

            $table->double('preco', 8, 2);

            $table->double('frete_preco', 8, 2)->dafault(0.00);

            $table->string('frete_tipo')->nullable();

            $table->string('moeda');

            $table->double('taxa_plataforma', 8, 2)->dafault(2.00);

            $table->double('impostos', 8, 2)->dafault(0.00);

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
        Schema::dropIfExists('produto_precos');
    }
}
