<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class welcomemsg extends Model
{
    protected $fillable = ['user_id','msg'];
}
