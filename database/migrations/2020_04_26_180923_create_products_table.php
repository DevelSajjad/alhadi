<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('slug');
            $table->bigInteger('brand_id');
            $table->bigInteger('category_id');
            $table->bigInteger('sub_category_id');
            $table->string('thumbnail_image');
            $table->longText('description');
            $table->longText('specification');
            $table->float('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('include')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('made_is')->nullable();
            $table->double('previous_price')->default(0);
            $table->double('price');
            $table->string('made_in')->nullable();
            $table->string('color')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('total_sell')->default(0);
            $table->string('clearing_sale')->default('no');
            $table->string('best_seller')->default("true");
            $table->string('status')->default('active');
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_tags')->nullable();
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
        Schema::dropIfExists('products');
    }
}
