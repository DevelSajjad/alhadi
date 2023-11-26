<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Sluggable;
    protected $table = 'brands';
    protected $fillable = ['name', 'slug', 'image', 'status'];

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

  
  public function subcategories()
  {
      return $this->belongsToMany (SubCategory::class, with(new SubCategoryBrand)->getTable());
  }
}
