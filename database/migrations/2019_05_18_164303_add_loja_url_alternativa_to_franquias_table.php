<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLojaUrlAlternativaToFranquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('franquias', function (Blueprint $table) {
            //
            //Url Alternativa loja
            $table->string('loja_url_alternativa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('franquias', function (Blueprint $table) {
            //
            $table->dropColumn('loja_url_alternativa');
        });
    }
}
