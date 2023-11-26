<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
      'user_id',
      'order_id',
      'old_status',
      'new_status',
      'status',
    ];
}
