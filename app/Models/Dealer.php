<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
      protected $fillable = ['customer_id', 'aria', 'selltarget', 'comp','bonus_amount'];
}
