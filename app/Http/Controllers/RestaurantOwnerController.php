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
	$tables = RestaurantTable::where('restaurant_id', '=', $id)->orderBy('capacity', 'asc')->orderBy('booking_fee', 'asc')->get();
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
	return redirect('restaurant_info_update/'.$id);
    }
    public function storeRestaurant(Request $req)
    {
        $restaurant = new Restaurant();
        $restaurant->name = $req->input('name');
        $restaurant->location = $req->input('location');
        $restaurant->email = $req->input('email');
        $restaurant->contact_number = $req->input('Contact');
        $restaurant->website = $req->input('website');
	$restaurant->description = $req->input('description');
	$restaurant->owner_id = Auth::user()->id;
	if($req->hasFile('image') && $req->file('image')->isValid()){
	    $image_file = $req->file('image');
	    $req->file('image')->move('img/', $restaurant->name.$req->file('image')->getClientOriginalName());
	    $restaurant->img_name = $restaurant->name.$req->file('image')->getClientOriginalName(); 
	}
	$this->validate($req, [
		'name' => 'required',
		'Contact' => 'required|integer'
	]) ;
	$restaurant->save();
	return redirect('/account');
    }
    public function addRestaurantTable(Request $req, $id)
    {
	$rest = Restaurant::find($id);
	$quantity = $req->input('new_num_of_tables');
	$capacity = $req->input('new_capacity');
	$booking_fee = $req->input('new_booking_fee');
	for($i = 0; $i < $quantity; $i++)
	{
	    $table = new RestaurantTable();
	    $table->restaurant_id = $id;
	    $table->capacity = $capacity;
	    $table->booking_fee = $booking_fee;
	    $table->save();
	}
	return redirect('restaurant_info_update/'.$id);
    }
    public function updateRestaurantTable(Request $req, $table_id)
    {
	$table = RestaurantTable::find($table_id);
	$table->capacity = $req->input('capacity');
	$table->booking_fee = $req->input('booking_fee');
	$table->save();
	return redirect()->back();
    }
}
