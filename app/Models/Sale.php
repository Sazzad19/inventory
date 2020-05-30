<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_id','product_id', 'quantity', 'price', 'saller_name','comp', 'sales_date', 'created_at', 'updated_at'];
}
