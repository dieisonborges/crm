<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagemFranquiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagem_franquia', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('upload_id')->unsigned();
            $table->foreign('upload_id')
                    ->references('id')
                    ->on('uploads')
                    ->onDelete('cascade');
            
            $table->integer('franquia_id')->unsigned();
            $table->foreign('franquia_id')
                    ->references('id')
                    ->on('franquias')
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
        Schema::dropIfExists('imagem_franquia');
    }
}
