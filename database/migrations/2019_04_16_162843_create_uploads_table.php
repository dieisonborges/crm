<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            //titulo do arquivo
            $table->string('titulo');
            //nome do arquivo
            $table->mediumText('link');
            //pasta
            $table->mediumText('dir');
            //extensao = .jpg, pdf e etc
            $table->string('ext');
            //Tipo de arquivo
            $table->string('tipo');
            //Nome Original
            $table->string('nome');
            //Tamanho do arquivo
            $table->string('tam');

            $table->integer('valor')->default(0);

            $table->timestamps();
        });

        Schema::create('upload_ticket', function (Blueprint $table) {
            $table->increments('id');            

            $table->integer('upload_id')->unsigned();
            $table->foreign('upload_id')
                    ->references('id')
                    ->on('uploads')
                    ->onDelete('cascade');
            
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets')
                    ->onDelete('cascade');     

            $table->timestamps();
        });

        

        Schema::create('imagem_user', function (Blueprint $table) {
            $table->increments('id');            

            $table->integer('upload_id')->unsigned();
            $table->foreign('upload_id')
                    ->references('id')
                    ->on('uploads')
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
        Schema::dropIfExists('imagem_user');
        Schema::dropIfExists('upload_ticket');
        Schema::dropIfExists('uploads');
    }
}
