<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValorProdutoToCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Valor da Categoria
        Schema::table('categorias', function (Blueprint $table) {
            //
            $table->integer('valor')->default(0);
        });

        //Produto Categoria
        Schema::create('categoria_produto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();            

            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('categoria_produto');

        Schema::table('categorias', function (Blueprint $table) {
            //
            $table->dropColumn('valor');
        });
    }
}
