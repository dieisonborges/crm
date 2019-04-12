<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {

            $table->increments('id');

            //1 - Ativo 0 - Desativada
            $table->integer('status')->unsigned()->default('1');

            $table->string('nome_fantasia');
            $table->string('email');
            $table->string('responsavel');

            $table->string('razao_social')->nullable();
            $table->string('cnpj')->nullable();

            $table->mediumText('descricao')->nullable(); 

            //Sites                            
            $table->mediumText('url_site')->nullable();
            $table->mediumText('url_loja')->nullable();
            $table->mediumText('url_blog')->nullable();
            //Móvel
            $table->string('telefone');

            $table->string('skype')->nullable();
            $table->string('wechat')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();            
            $table->string('twitter')->nullable();        
            //endereço
            $table->string('endereco')->nullable();
            $table->string('endereco_numero')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->string('endereco_cidade')->nullable();
            $table->string('endereco_estado')->nullable();
            $table->string('endereco_pais')->nullable();
            $table->string('endereco_cep')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('fornecedors');
    }
}
