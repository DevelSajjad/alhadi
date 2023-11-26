<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $fillable = [
        'email',
        'customer_id',
        'name',
        'contact_no'
    ];
}
