<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation_Table extends Model
{
    //
    protected $table = 'reservation_table';
    public $timestamps = false;
    protected $fillable = ['restaurant_id', 'reservation_id', 'table_number'];
}
