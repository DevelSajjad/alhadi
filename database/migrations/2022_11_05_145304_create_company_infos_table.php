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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('logo')->default('dummy.jpg')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('email_one')->nullable();
            $table->string('email_two')->nullable();
            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
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
        Schema::dropIfExists('company_infos');
    }
};
