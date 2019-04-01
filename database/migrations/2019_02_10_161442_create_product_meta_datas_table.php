<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMetaDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_meta_datas', function (Blueprint $table) {
            $table->increments('id');
            // $table->bigInteger('product_code')->unique();
            $table->string('product_name')->unique();
            $table->string('product_category')->nullable();
            $table->string('product_image')->nullable();
            // $table->string('customer_type')->nullable();
            // $table->boolean('active_flag');
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
        Schema::dropIfExists('product_meta_datas');
    }
}
