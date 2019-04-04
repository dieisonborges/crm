<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePnSnStatusToCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorias', function (Blueprint $table) {
            //INVERTIDO
            $table->dropColumn('part_number');
            $table->dropColumn('serial_number');
            $table->dropColumn('status');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorias', function (Blueprint $table) {
            //INVERTIDO
            $table->string('part_number')->nullable();
            $table->string('serial_number')->nullable();
            // 0 = INOPERANTE
            // 1 = OPERACIONAL
            $table->integer('status')->unsigned()->default('1');
        });
    }
}
