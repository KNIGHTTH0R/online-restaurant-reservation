<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $table = 'restaurant';
    public $timestamps = false;
    protected $fillable = ['name', 'location', 'email', 'contact_number', 'website', 'parking_available', 'description'];
    public function reviews()
    {
        return $this->hasMany('App\Review', 'restaurant_id');
    }
    public function restaurant_tables()
    {
        return $this->hasMany('App\RestaurantTable', 'restaurant_id');
    }

    public function food_menus()
    {
        return $this->hasMany('App\Food_Menu', 'restaurant_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Restaurant_category', 'offered_category', 'category_id', 'restaurant_id');
    }
}
