<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('customer_id');
            $table->string('paid_by')->nullable();
            $table->longText('response')->nullable();
            $table->string('transaction_id',75)->nullable();
            $table->string('card_type')->nullable();
            $table->string('type', 20);
            $table->double('amount');
            $table->string('status', 20);
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
        Schema::dropIfExists('payments');
    }
}
