<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $fillable = ['image','title'];

    public function supplier() 
    {
    	return $this->hasMany('App\supplier');
    }

    public function profile() {
    	return $this->hasMany('App\profile');
    }
}
