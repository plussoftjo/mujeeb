<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    protected $fillable =['type','order_id','message','hasImage','image'];
}
