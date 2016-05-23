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
}
