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
		$reservation_date =  date_format(date_create_from_format('d/m/Y', $req->input('reservation-date')),"Y-m-d");
		$reservation_time =  $req->input('reservation-time');
		

		///Do query here
		$suitable_tables = DB::select('select * from restaurant_table where capacity >= ?  and restaurant_id = ? and id not in (select distinct rt.table_number from reservation rv join reservation_table rt on rv.id = rt.reservation_id where rv.reservation_date = ? and rv.reservation_time_slot = ?)', [$num_of_persons, $rest_id, $reservation_date, $reservation_time]);

		$other_free_tables = DB::select('select * from restaurant_table where capacity < ?  and restaurant_id = ? and id not in (select distinct rt.table_number from reservation rv join reservation_table rt on rv.id = rt.reservation_id where rv.reservation_date = ? and rv.reservation_time_slot = ?)', [$num_of_persons, $rest_id, $reservation_date, $reservation_time]);

		return view('restaurant.book_table', ['suitable_tables' => $suitable_tables, 'other_free_tables' => $other_free_tables, 'restaurant_id' => $rest_id]);
    }

    public function reserveTables(Request $req){
    	foreach ($req->all() as $key => $value) {
		 	if($key == "_token");
		 	else{
		 		echo $key.'\n';
		 	}
		}
    }
}
