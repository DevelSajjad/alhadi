<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->longText('products');
            $table->double('amount');
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('area');
            $table->string('delivery_address');
            $table->double('delivery_charge');
            $table->string('vat')->default(0);
            $table->string('delivered_by')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('orders');
    }
}
