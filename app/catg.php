<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catg extends Model
{
    protected $fillable =['title','image'];

    public function orders() {
    	return $this->hasMany('App\order');
    }
}
