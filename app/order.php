<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
	public $with = ['user','catg','subcatg'];
    protected $fillable = ['user_id','auth','date','lngLat','des','images','state','type','catg_id','subcatg_id'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function catg() {
    	return $this->belongsTo('App\catg');
    }

    public function subcatg() {
    	return $this->belongsTo('App\subcatg');
    }
}
