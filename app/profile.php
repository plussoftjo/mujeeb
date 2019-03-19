<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
   public $with = ['user','country','city','subcity'];
   protected $fillable = ['user_id','country_id','city_id','subcity_id'];

   public function user() {
   	return $this->belongsTo('App\User');
   }

   public function country() {
   	return $this->belongsTo('App\country');
   }
   public function city() {
   	return $this->belongsTo('App\city');
   }
   public function subcity() {
   	return $this->belongsTo('App\subcity');
   }
}
