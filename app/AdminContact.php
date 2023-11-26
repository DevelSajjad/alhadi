<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminContact extends Model
{
    protected $table = 'admin_contacts';
    protected $fillable = [
      'mobile_no'
    ];
}
