<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    protected $table = 'restaurant_table';
    public $timestamps = false;
    protected $fillable = ['restaurant_id', 'capacity', 'booking_fee'];
    
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant', 'restaurant_id');
    }


}
