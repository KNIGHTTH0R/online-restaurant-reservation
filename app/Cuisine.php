<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    //
   	protected $table = 'cuisine';
   	public $timestamps = false;
   	public function restaurants()
   	{
   		return $this->hasMany('App\Restaurant', 'restaurant_id');
   	}
}
