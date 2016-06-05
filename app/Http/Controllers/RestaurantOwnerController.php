<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Restaurant;
use App\RestaurantTable;
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
    public function showUpdateRestaurant($id)
    {
	$rest = Restaurant::find($id);
	$tables = RestaurantTable::where('restaurant_id', '=', $id)->get();
	return view('restaurantOwner.restaurant_info_update', ['restaurants' => $rest, 'restaurant_tables' => $tables]);
    }
    public function updateRestaurant(Request $req, $id)
    {
	$rest = Restaurant::find($id);
	$rest->location = $req->input('location');
	$rest->email = $req->input('email');
	$rest->contact_number = $req->input('contact');
	$rest->website = $req->input('website');
	$rest->description = $req->input('desc');
	$rest->save();
	return redirect('/account');
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
