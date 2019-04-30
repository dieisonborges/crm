<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franquias', function (Blueprint $table) {
            $table->increments('id');

            //Código gerado pelo sistema + id
            $table->string('codigo_franquia')->unique();

            //Dados da Franquia
            $table->string('nome');
            $table->string('slogan');
            $table->mediumText('descricao');                             
            $table->mediumText('url_site')->nullable();
            $table->mediumText('url_blog')->nullable();         
            

            //1 - Ativo 0 - Desativada
            $table->integer('status')->unsigned()->default('1');

            //Link URL  LOJA
            $table->mediumText('loja_url')->nullable(); 

            //Foi removido nas proximas migracoes *********************************************
            //Banco de Dados - OpenCart
            $table->string('loja_database_url')->nullable();
            $table->string('loja_database_name')->nullable();
            $table->string('loja_database_user')->nullable();
            //base64_encode(database_password_salt + database_password + APP_HASH_ENCODE)
            $table->mediumText('loja_database_password')->nullable();
            $table->mediumText('loja_database_password_salt')->nullable();
            // END foi removido ***************************************************************

            // Quem indicou a franquia Unilevel
            // Líder
            // Não é o ID do Dono da loja
            $table->integer('user_id_afiliado')->unsigned()->nullable();
            $table->foreign('user_id_afiliado')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->timestamps();
        });

        //Usuário de Gerência/Dono da franquia
        Schema::create('franquia_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('franquia_id')->unsigned();
            

            $table->foreign('franquia_id')
                    ->references('id')
                    ->on('franquias')
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
        Schema::dropIfExists('franquia_user');
        Schema::dropIfExists('franquias');
    }
}
