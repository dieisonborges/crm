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

            //URL ALternativa (Sub dominio .venderaqui)
            $table->string('loja_url_alternativa')->unique();
            

            // Quem indicou a franquia Unilevel
            // Líder
            // Não é o ID do Dono da loja
            $table->integer('user_id_afiliado')->unsigned()->nullable();
            $table->foreign('user_id_afiliado')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->string('cnpj')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->integer('endereco_numero')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->string('endereco_cidade')->nullable();
            $table->string('endereco_estado')->nullable();
            $table->string('endereco_cep')->nullable();

            $table->double('lucro', 8, 2)->dafault(10.00);

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
