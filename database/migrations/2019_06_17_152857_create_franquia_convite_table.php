<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranquiaConviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franquia_convite', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('franquia_id')->unsigned()->nullable();
            $table->foreign('franquia_id')
                    ->references('id')
                    ->on('franquias')
                    ->onDelete('cascade');

            $table->integer('convite_id')->unsigned()->nullable();
            $table->foreign('convite_id')
                    ->references('id')
                    ->on('convites')
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
        Schema::dropIfExists('franquia_convite');
    }
}
