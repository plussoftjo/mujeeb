<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
	public $with =['user','supplier','order'];
    protected $fillable = ['user_id','supplier_id','order_id','note','rate'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function supplier() {
    	return $this->belongsTo('App\supplier');
    }
    public function order() {
    	return $this->belongsTo('App\order');
    }
}
