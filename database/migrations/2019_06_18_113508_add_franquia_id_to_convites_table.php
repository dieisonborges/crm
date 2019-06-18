<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFranquiaIdToConvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convites', function (Blueprint $table) {
            //
            //Franquia que foi criada pelo convite
            $table->integer('franquia_id')->unsigned()->nullable();
            $table->foreign('franquia_id')
                    ->references('id')
                    ->on('franquias')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convites', function (Blueprint $table) {
            //

            $table->dropColumn('franquia_id');
            
        });
    }
}
