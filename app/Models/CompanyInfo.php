<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

  protected $table = 'company_infos';
  protected $fillable = [
    'company_name',
    'logo',
    'address_one',
    'address_two',
    'email_one',
    'email_two',
    'phone_one',
    'phone_two',
    'trade_license',
  ];
}
