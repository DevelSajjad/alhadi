<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;

    protected $table = 'products';
    protected $fillable = [
      'name',
      'code',
      'slug',
      'brand_id',
      'category_id',
      'sub_category_id',
      'thumbnail_image',
      'description',
      'specification',
      'weight',
      'dimensions',
      'include',
      'guarantee',
      'previous_price',
      'price',
      'made_in',
      'color',
      'quantity',
      'total_sell',
      'clearing_sale',
      'status',
      'best_seller',
      'meta_title',
      'meta_description',
      'meta_tags'

    ];

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }
}
