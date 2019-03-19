<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $fillable =['country_id','title'];
    
    public function supplier() 
    {
    	return $this->hasMany('App\supplier');
    }

    public function profile() {
    	return $this->hasMany('App\profile');
    }
}
