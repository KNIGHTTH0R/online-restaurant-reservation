<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RestaurantController extends Controller
{
    //
    public function search(Request $request)
    {
    	
    	return $request->input('reservation-date');
    }
}
