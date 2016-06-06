<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Restaurant;
use App\RestaurantTable;
use App\Food_Menu;
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
	$food_menus = Food_Menu::where('restaurant_id', '=', $id)->get();
	return view('restaurantOwner.restaurant_info_update', ['restaurants' => $rest, 'restaurant_tables' => $tables, 'food_menus' => $food_menus]);
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
        $restaurant->contact_number = $req->input('contactno');
        $restaurant->website = $req->input('website');
	$restaurant->description = $req->input('description');
	$restaurant->owner_id = Auth::user()->id;
	if($req->hasFile('image') && $req->file('image')->isValid()){
	    $image_file = $req->file('image');
	    $req->file('image')->move('img/', $restaurant->name.$req->file('image')->getClientOriginalName());
	    $restaurant->img_name = $restaurant->name.$req->file('image')->getClientOriginalName(); 
	}
	$restaurant->save();
	return redirect('/account');
    }
    public function updateFoodMenu(Request $req, $menu_id)
    {
	$food_menu = Food_Menu::find($menu_id);
	$food_menu->name = $req->menu_name;
	$food_menu->price = $req->menu_price;
	$food_menu->category = $req->menu_category;
	$food_menu->save();
	return redirect()->back();
    }
    public function addFoodMenu(Request $req, $id)
    {
	//$rest = Restaurant::find($id);
	$food_menu = new Food_Menu();
	$food_menu->restaurant_id = $id;
	$food_menu->name = $req->new_menu_name;
	$food_menu->price = $req->new_menu_price;
	$food_menu->category = $req->new_menu_category;
	if($req->hasFile('new_menu_image') && $req->file('new_menu_image')->isValid()){
	    $image_file = $req->file('new_menu_image');
	    $req->file('new_menu_image')->move('img/', $restaurant->name.$req->file('new_menu_image')->getClientOriginalName());
	    $food_menu->img_name = $restaurant->name.$req->file('new_menu_image')->getClientOriginalName(); 
	}
	$food_menu->save();
	return redirect()->back();
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
