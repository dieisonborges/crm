<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWpconfigToFranquiasTable extends Migration
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
            $table->string('WP_HOME')->nullable();
            $table->string('WP_SITEURL')->nullable();
            $table->string('DB_NAME')->nullable();
            $table->string('DB_USER')->nullable();
            $table->string('DB_PASSWORD')->nullable();
            $table->string('DB_HOST')->nullable();
            $table->string('DB_CHARSET')->nullable();
            $table->string('DB_COLLATE')->nullable();

            //Integração via API Woocommerce
            $table->string('store_url')->nullable();
            $table->string('consumer_key')->nullable();
            $table->string('consumer_secret')->nullable();
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
            $table->dropColumn('WP_HOME');
            $table->dropColumn('WP_SITEURL');
            $table->dropColumn('DB_NAME');
            $table->dropColumn('DB_USER');
            $table->dropColumn('DB_PASSWORD');
            $table->dropColumn('DB_HOST');
            $table->dropColumn('DB_CHARSET');
            $table->dropColumn('DB_COLLATE');

            //Integração via API Woocommerce
            $table->dropColumn('store_url')->nullable();
            $table->dropColumn('consumer_key')->nullable();
            $table->dropColumn('consumer_secret')->nullable();
            
        });
    }
}
