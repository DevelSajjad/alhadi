<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = [
      'email',
      'name',
      'mobile_no',
      'message'
    ];
}
