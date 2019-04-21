<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bankaccount extends Model
{
   	protected $fillable = ['account_number','place','bank_name','account_name'];
}
