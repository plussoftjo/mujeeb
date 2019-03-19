<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
	public $with =['country','city',];
    protected $fillable = ['user_id','country_id','city_id','subcity_id','catg_id','subcatg_id','image'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function country() {
    	return $this->belongsTo('App\country');
    }

    public function city() {
    	return $this->belongsTo('App\city');
    }
    
}
