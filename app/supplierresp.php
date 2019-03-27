<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplierresp extends Model
{
	public $with = ['user'];
    protected $fillable = ['user_id','order_id','price','des'];

    public function order() {
    	return $this->belongsTo('App\order');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
