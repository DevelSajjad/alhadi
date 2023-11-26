<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestSellingProduct extends Model
{
    protected $table = 'best_selling_products';
    protected $fillable = [
      'customer_id',
      'order_id',
      'product_id',
      'number_of_product_sale',
    ];
}
