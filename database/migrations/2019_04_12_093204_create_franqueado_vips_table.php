<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranqueadoVipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //*** Só pode ser franqueado Líder se for franqueado VIP também
        Schema::create('franqueado_vips', function (Blueprint $table) {
            $table->increments('id');
            //1 = Líder | 0 = Não é Líder
            $table->integer('lider')->default(0);

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
        Schema::dropIfExists('franqueado_vips');
    }
}
