<?php

namespace App;

use App\SubCategoryBrand;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
  use Sluggable;

  protected $table ="sub_categories";
  protected $fillable = [ 'category_id', 'name', 'slug', 'status'];


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


  public function brands()
  {
      return $this->belongsToMany (Brand::class, with(new SubCategoryBrand)->getTable());
  }
}
