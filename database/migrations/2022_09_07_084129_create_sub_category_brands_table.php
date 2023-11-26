<?php

use App\SubCategoryBrand;
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
        Schema::create(with(new SubCategoryBrand)->getTable(), function (Blueprint $table) {
            $table->bigInteger('sub_category_id');
            $table->bigInteger('brand_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(with(new SubCategoryBrand)->getTable());
    }
};
