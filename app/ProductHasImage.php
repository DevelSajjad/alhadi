<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductHasImage extends Model
{
  protected $table = 'product_has_images';
  protected $fillable = ['product_id', 'image' ];
}
