<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcatg extends Model
{
    protected $fillable = ['image','catg_id','title'];

    public function orders() {
    	return $this->hasMany('App\order');
    }

    public function team() {
    	return $this->hasMany('App\team');
    }
}
