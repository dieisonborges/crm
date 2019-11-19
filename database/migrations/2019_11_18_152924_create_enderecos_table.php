<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            //Endereço no padrão do Wordpress
            $table->increments('id');
            $table->string('label');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('country');
            $table->timestamps();
        });

        Schema::create('endereco_user', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('endereco_id')->unsigned();
            $table->foreign('endereco_id')
                    ->references('id')
                    ->on('enderecos')
                    ->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('endereco_user');
        Schema::dropIfExists('enderecos');
    }
}
