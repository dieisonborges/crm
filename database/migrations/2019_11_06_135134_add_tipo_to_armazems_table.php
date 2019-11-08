<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoToArmazemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('armazems', function (Blueprint $table) {
            //Tipo de Estoque
            /*
            
            @if($armazem->tipo==0)
            <option value="0" selected="selected">Revenda (Estoque de Terceiros)</option>
            @elseif($armazem->tipo==1)
            <option value="1" selected="selected">Fulfillment (Estoque Próprio Internacional)</option>
            @elseif($armazem->tipo==2)
            <option value="2" selected="selected">Fulfillment (Estoque Próprio Nacional)</option>
            @elseif($armazem->tipo==3)
            <option value="3" selected="selected">Armazém Próprio Nacional</option>
            @endif
            
            */
            $table->integer('tipo')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('armazems', function (Blueprint $table) {
            //
            $table->dropColumn('tipo');
        });
    }
}
