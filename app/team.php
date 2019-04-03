<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
	public $with = ['subcatg'];
    protected $fillable = ['name','supplier_id','image','subcatg_id'];


    public function subcatg() {
    	return $this->belongsTo('App\subcatg');
    }
}
