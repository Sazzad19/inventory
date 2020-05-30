<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
       protected $fillable = ['name', 'address', 'phone_number', 'salary','created_by','modified_by','comp'];
}
