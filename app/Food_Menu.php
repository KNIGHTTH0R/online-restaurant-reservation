<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_Menu extends Model
{
    //
    protected $table = 'food_menu';
    public $timestamps = false;


    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant', 'restaurant_id');
    }
}
