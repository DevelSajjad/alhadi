<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use  Sluggable;
    protected $table ="categories";
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
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
  }
}
