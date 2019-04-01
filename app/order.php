<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
	public $with = ['user','catg','subcatg','supplierresp','feedback'];
    protected $fillable = ['user_id','auth','date','lngLat','des','images','state','type','catg_id','subcatg_id','time'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function catg() {
    	return $this->belongsTo('App\catg');
    }

    public function subcatg() {
    	return $this->belongsTo('App\subcatg');
    }

    public function sppliernotf() {
        return $this->hasMany('App\suppliernotf');
    }
    public function supplierresp() {
        return $this->hasMany('App\supplierresp');
    }

    public function feedback() {
        return $this->hasOne('App\feedback');
    }
}
