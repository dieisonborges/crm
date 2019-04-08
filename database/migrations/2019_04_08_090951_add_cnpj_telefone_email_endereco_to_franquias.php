<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCnpjTelefoneEmailEnderecoToFranquias extends Migration
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
            $table->string('cnpj')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->integer('endereco_numero')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->string('endereco_cidade')->nullable();
            $table->string('endereco_estado')->nullable();
            $table->string('endereco_cep')->nullable();
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
            
            $table->dropColumn('cnpj');
            $table->dropColumn('telefone');
            $table->dropColumn('email');
            $table->dropColumn('endereco');
            $table->dropColumn('endereco_numero');
            $table->dropColumn('endereco_bairro');
            $table->dropColumn('endereco_cidade');
            $table->dropColumn('endereco_estado');
            $table->dropColumn('endereco_cep');
            
        });
    }
}
