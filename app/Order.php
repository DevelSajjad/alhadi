<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'products',
        'amount',
        'delivery_address',
        'payment_type',
        'payment_status',
        'delivery_charge',
        'vat',
        'area',
        'delivered_by',
        'status',
    ];
}
