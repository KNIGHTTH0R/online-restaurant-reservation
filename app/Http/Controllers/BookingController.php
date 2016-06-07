<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BookingController extends Controller
{
    //
    public function book(Request $req)
    {
		$rest_id = $req->input('restaurant-id');
		$num_of_persons =  $req->input('num-of-persons');
		$reservation_date =  $req->input('reservation-date');
		$reservation_time =  $req->input('reservation-time');

		///Do query here

		return view('restaurant.book_table', );
    }
}
