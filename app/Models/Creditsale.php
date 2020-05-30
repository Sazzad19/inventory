<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creditsale extends Model
{
  protected $fillable = ['customer_id','product_id', 'price', 'quantity', 'saller_name', 'sales_date', 'sales_status', 'birthday_status', 'dob', 'phone', 'created_at', 'updated_at'];

}
