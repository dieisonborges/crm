<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');

            $table->string('codigo')->unique();

            //Usuário que efetuou a compra
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->timestamps();

        });

        Schema::create('item_compra', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('quantidade');


            //Produto Preco
            $table->integer('produto_precos_id')->unsigned();
            $table->foreign('produto_precos_id')
                    ->references('id')
                    ->on('produto_precos')
                    ->onDelete('cascade');

            //Quantidade em estoque
            $table->string('quantidade');

            $table->string('unidade_medida');

            $table->double('preco', 8, 2);

            $table->double('frete_preco', 8, 2)->dafault(0.00);

            $table->string('frete_tipo')->nullable();

            $table->integer('moeda_id')->unsigned();
            $table->foreign('moeda_id')
                    ->references('id')
                    ->on('moedas')
                    ->onDelete('cascade');

            $table->double('taxa_plataforma', 8, 2)->dafault(2.00);

            $table->double('impostos', 8, 2)->dafault(0.00);

            //Valor da Moeda Estrageira no dia
            $table->double('taxa_cambio', 8, 2);
            

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
        Schema::dropIfExists('compras');

        Schema::dropIfExists('item_compra');
    }
}
