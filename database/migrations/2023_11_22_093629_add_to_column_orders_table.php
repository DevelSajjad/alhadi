<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('billing_name');
            $table->string('billing_phone');
            $table->text('billing_address');
            $table->string('shipping_name')->nullable();
            $table->text('customer_say')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('billing_name');
            $table->dropColumn('billing_phone');
            $table->dropColumn('billing_address');
            $table->dropColumn('shipping_name');
            $table->dropColumn('customer_say');
        });
    }
};
