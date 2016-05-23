<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $table = 'restaurant';
    public $timestamps = false;

    public function reviews()
    {
        return $this->hasMany('App\Review', 'restaurant_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Restaurant_category', 'offered_category', 'category_id', 'restaurant_id');
    }
}
