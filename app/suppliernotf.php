<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suppliernotf extends Model
{
	public $with = ['order'];
    protected $fillable = ['order_id','user_id','state'];

    public function order() {
    	return $this->belongsTo('App\order');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

}
