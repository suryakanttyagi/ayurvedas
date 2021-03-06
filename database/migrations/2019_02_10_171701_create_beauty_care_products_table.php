<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeautyCareProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beauty_care_products', function (Blueprint $table) {
            $table->increments('id');
            // $table->bigInteger('product_id')->references('id')->on('product_meta_datas')->onDelete('cascade');
            // $table->bigInteger('product_code')->unique();
            $table->string('product_name')->unique();

            //for the search purpose
            $table->longText('product_details')->nullable();
            $table->longText('product_keywords')->nullable();
            $table->longText('product_prescription')->nullable();
            $table->longText('product_for_disease')->nullable();
            $table->longText('product_ingredients')->nullable();

            $table->string('product_category')->nullable();
            // $table->string('customer_type')->nullable();
            // $table->boolean('active_flag');
            // $table->boolean('discount_flag');

            $table->integer('product_cost')->nullable();
            $table->integer('imc_member_discount')->nullable();

            $table->longText('product_image')->nullable();

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
        Schema::dropIfExists('beauty_care_products');
    }
}
