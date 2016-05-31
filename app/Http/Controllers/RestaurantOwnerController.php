<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Restaurant;
use Auth;

class RestaurantOwnerController extends Controller
{
    //
    public function showAddRestaurant()
    {
        if(\Auth::check() && \Auth::user()->user_type == 1)
        {
            return view('restaurantOwner.showAddRestaurant');
        }
        else
        {
            return redirect('/login');
        }
    }
    
    public function storeRestaurant(Request $req)
    {
        //$parking = (isset(
        $restaurant = new Restaurant();
        $restaurant->name = $req->input('name');
        $restaurant->location = $req->input('location');
        $restaurant->email = $req->input('email');
        $restaurant->contact_number = $req->input('contactno');
        $restaurant->website = $req->input('website');
	$restaurant->description = $req->input('description');
	$restaurant->owner_id = Auth::user()->id;
	$restaurant->save();
	return redirect('/account');
    }

}
