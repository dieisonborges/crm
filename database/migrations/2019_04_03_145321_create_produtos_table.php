<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            //Código de integração, gerado pelo sistema
            $table->string('sku')->unique();
            $table->string('titulo');                        
            $table->string('palavras_chave');
            $table->longText('descricao');

            //1 - Ativo 0 - Desativado
            $table->integer('status')->unsigned()->default(1);

            //Cubagem
            $table->string('altura')->nullable();
            $table->string('largura')->nullable();
            $table->string('comprimento')->nullable();
            $table->string('peso')->nullable();
            //link de referencia
            $table->mediumText('link_referencia')->nullable();

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
        Schema::dropIfExists('produtos');
    }
}
