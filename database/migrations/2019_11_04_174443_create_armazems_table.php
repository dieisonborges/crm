<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmazemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Armazem Integrado via API Woocommerce
        Schema::create('armazems', function (Blueprint $table) {
            $table->increments('id');

            //Status
            // 0 - Desativado
            // 1 - Ativo
            $table->string('status')->default(0);

            //Localização
            $table->string('nome');

            //Localização
            $table->string('localizacao')->nullable();

            //Integração via API Woocommerce
            $table->string('store_url')->nullable();
            $table->string('consumer_key')->nullable();
            $table->string('consumer_secret')->nullable();

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
        Schema::dropIfExists('armazems');
    }
}
