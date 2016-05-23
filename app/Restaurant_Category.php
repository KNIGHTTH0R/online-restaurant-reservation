<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant_Category extends Model
{
    //
    protected $table = 'restaurant_category';
    public $timestamps = false;

    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurant', 'offered_category', 'category_id', 'restaurant_id');
    }
}
