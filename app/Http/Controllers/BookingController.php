<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class BookingController extends Controller
{
    //
    public function book(Request $req)
    {
		$rest_id = $req->input('restaurant-id');
		$num_of_persons =  $req->input('num-of-persons');
		$reservation_date =  $req->input('reservation-date');
		$reservation_time =  $req->input('reservation-time');
		$reservation_date = '2016-06-07';

		///Do query here
		$available_tables = DB::select('select * from restaurant_table where restaurant_id = ? and id not in (select distinct rt.table_number from reservation rv join reservation_table rt on rv.id = rt.reservation_id where rv.reservation_date = ? and rv.reservation_time_slot = ?)', [$rest_id, $reservation_date, $reservation_time]);

		return view('restaurant.book_table', ['available_tables' => $available_tables]);
    }
}
