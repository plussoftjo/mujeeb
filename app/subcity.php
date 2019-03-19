<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcity extends Model
{
    protected $fillable =['title','city_id'];

    public function profile() {
    	return $this->hasMany('App\profile');
    }
}
