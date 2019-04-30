<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveOpencartDataToFranquias extends Migration
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
            //INVERTIDO
            $table->dropColumn('loja_database_url');
            $table->dropColumn('loja_database_name');
            $table->dropColumn('loja_database_user');
            $table->dropColumn('loja_database_password');
            $table->dropColumn('loja_database_password_salt');
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
            //INVERTIDO            
            $table->string('loja_database_url')->nullable();
            $table->string('loja_database_name')->nullable();
            $table->string('loja_database_user')->nullable();
            //base64_encode(database_password_salt + database_password + APP_HASH_ENCODE)
            $table->mediumText('loja_database_password')->nullable();
            $table->mediumText('loja_database_password_salt')->nullable();
        });
    }
}
