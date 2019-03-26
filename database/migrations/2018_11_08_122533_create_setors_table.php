<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('label', 200);
            $table->timestamps();
        });        

        Schema::create('setor_ticket', function (Blueprint $table) {
            $table->increments('id');            

            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')
                    ->references('id')
                    ->on('setors')
                    ->onDelete('cascade');
            
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onDelete('cascade');     

            $table->timestamps();
        });

        Schema::create('setor_user', function (Blueprint $table) {
            $table->increments('id');  

            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')
                    ->references('id')
                    ->on('setors')
                    ->onDelete('cascade');           

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade'); 

            $table->timestamps();
        });

        Schema::create('setor_categoria', function (Blueprint $table) {
            $table->increments('id');  

            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')
                    ->references('id')
                    ->on('setors')
                    ->onDelete('cascade');           

            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
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
        Schema::dropIfExists('setor_categoria');
        Schema::dropIfExists('setor_ticket');
        Schema::dropIfExists('setor_user');
        Schema::dropIfExists('setors');
    }
}
