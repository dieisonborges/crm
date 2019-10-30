<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios', function (Blueprint $table) {
            $table->increments('id');
            //Moeda BASE = BRL
            //Código Moeda
            //USD
            $table->string('moeda');
            $table->double('valor', 15, 8);
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        //Valor Efetivo Total
        //Fator Multiplicador do Câmbio
        Schema::create('vets', function (Blueprint $table) {
            $table->increments('id');            
            $table->double('valor', 15, 8);
            $table->string('descricao')->nullable();
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
        Schema::dropIfExists('vets');
        Schema::dropIfExists('cambios');
    }
}
