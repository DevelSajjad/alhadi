<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestSellingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_selling_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('number_of_product_sale');
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
        Schema::dropIfExists('best_selling_products');
    }
}
