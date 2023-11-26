<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SideBanner extends Model
{
    protected $table = 'side_banners';
    protected $fillable = [
        'title',
        'banner_img',
        'status',
        'product_id'
    ];
}
