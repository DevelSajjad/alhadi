<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Brand;
use App\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class SubCategoryBrand extends Model
{

  protected $table ="sub_category_brand";
  protected $fillable = [ 'sub_category_id', 'brand_id'];

}
