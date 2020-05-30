<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = ['name', 'district', 'phone_number', 'code_number', 'due_amount','customer_type','created_by','modified_by','comp'];

}
