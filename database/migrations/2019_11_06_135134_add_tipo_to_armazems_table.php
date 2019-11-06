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
            // 0 - Revenda (Estoque de Terceiros)
            // 1 - Fulfillment (Estoque Próprio Internacional)
            // 2 - Fulfillment (Estoque Próprio Nacional)
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
