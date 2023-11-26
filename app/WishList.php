<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlists';
    protected $fillable = [
      'customer_id' ,
      'product_id',
      'status'
    ];
}
