<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoFranquiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_franquia', function (Blueprint $table) {
            $table->increments('id'); 

            //Franquia
            $table->integer('franquia_id')->unsigned()->nullable();
            $table->foreign('franquia_id')
                    ->references('id')
                    ->on('franquias')
                    ->onDelete('cascade');            

            //Produto
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')
                    ->references('id')
                    ->on('produtos')
                    ->onDelete('cascade');


            $table->double('lucro', 8, 2)->dafault(10.00);            

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
        Schema::dropIfExists('produto_franquia');
    }
}
