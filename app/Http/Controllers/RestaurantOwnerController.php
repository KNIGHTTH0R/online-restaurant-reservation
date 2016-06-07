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
    //public function __construct()
    //{
	//$this->middleware('auth');
    //}
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
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $rest = Restaurant::find($id);
	    if($rest->owner_id != Auth::user()->id)
	    {
		return redirect('/');
	    }
	    $tables = RestaurantTable::where('restaurant_id', '=', $id)->orderBy('capacity', 'asc')->orderBy('booking_fee', 'asc')->get();
	    $food_menus = Food_Menu::where('restaurant_id', '=', $id)->get();
	    return view('restaurantOwner.restaurant_info_update', ['restaurants' => $rest, 'restaurant_tables' => $tables, 'food_menus' => $food_menus]);
	}
	else
	{
	     return redirect('/login');
	}	    
    }
    public function updateRestaurant(Request $req, $id)
    {
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $rest = Restaurant::find($id);
	    if($rest->owner_id != Auth::user()->id)
	    {
		return redirect('/');
	    }

	    $rest->location = $req->input('location');
	    $rest->email = $req->input('email');
	    $rest->contact_number = $req->input('contact');
	    $rest->website = $req->input('website');
	    $rest->description = $req->input('desc');
	    $this->validate($req, [
		'location' => 'required',
		'contact' => 'required|integer',
		'email' => 'email'
	    ]) ;
	    if($req->hasFile('image') && $req->file('image')->isValid()){
		$this->validate($req, [
		    'image' => 'image'
		]);
		$image_file = $req->file('image');
		$req->file('image')->move('img/', $id.'_'.$req->file('image')->getClientOriginalName());
		unlink('./img/'.$rest->img_name);
		$rest->img_name = $id.'_'.$req->file('image')->getClientOriginalName(); 
	    }
	    $rest->save();
	    return redirect('restaurant_info_update/'.$id);
	}
	else
	{
	     return redirect('/login');
	}
    }
    public function storeRestaurant(Request $req)
    {
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $restaurant = new Restaurant();
	    $restaurant->name = $req->input('name');
	    $restaurant->location = $req->input('location');
	    $restaurant->email = $req->input('email');
	    $restaurant->contact_number = $req->input('Contact');
	    $restaurant->website = $req->input('website');
	    $restaurant->description = $req->input('description');
	    $restaurant->owner_id = Auth::user()->id;
	    $this->validate($req, [
		'name' => 'required',
		'location' => 'required',
		'Contact' => 'required',
		'email' => 'email'
	    ]) ;
	    if($req->hasFile('image') && $req->file('image')->isValid()){
		$this->validate($req, [
		    'image' => 'image'
		]);
		$restaurant->save();
		$image_file = $req->file('image');
		$req->file('image')->move('img/', $restaurant->id.'_'.$req->file('image')->getClientOriginalName());
		$restaurant->img_name = $restaurant->id.'_'.$req->file('image')->getClientOriginalName(); 
	    }
	    $restaurant->save();
	    return redirect('/account');
	}
	else
	{
	     return redirect('/login');
	}
    }
    public function updateFoodMenu(Request $req, $menu_id)
    {
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $food_menu = Food_Menu::find($menu_id);
	    $rest = Restaurant::find($food_menu->restaurant_id);
	    if($rest->owner_id != Auth::user()->id)
	    {
		return redirect('/');
	    }
	    $food_menu->name = $req->menu_name;
	    $food_menu->price = $req->menu_price;
	    $food_menu->category = $req->menu_category;
	    if($req->hasFile('menu_image') && $req->file('menu_image')->isValid()){
		$image_file = $req->file('menu_image');
		$req->file('menu_image')->move('img/', $food_menu->id.'_'.$req->file('menu_image')->getClientOriginalName());
		$food_menu->img_name = $food_menu->id.'_'.$req->file('menu_image')->getClientOriginalName(); 
	    }
	    $this->validate($req, [
		'menu_name' => 'required',
		'menu_price' => 'required|numeric',
	    ]);
	    $food_menu->save();
	    return redirect()->back();
	}
	else
	{
	     return redirect('/login');
	}
    }
    public function addFoodMenu(Request $req, $id)
    {
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $rest = Restaurant::find($id);
	    if($rest->owner_id != Auth::user()->id)
	    {
		return redirect('/');
	    }
	    $this->validate($req, [
		'new_menu_name' => 'required',
		'new_menu_price' => 'required|numeric',
	    ]) ;

	    $food_menu = new Food_Menu();
	    $food_menu->restaurant_id = $id;
	    $food_menu->name = $req->new_menu_name;
	    $food_menu->price = $req->new_menu_price;
	    $food_menu->category = $req->new_menu_category;
	    $food_menu->save();
	    if($req->hasFile('new_menu_image') && $req->file('new_menu_image')->isValid()){
		$image_file = $req->file('new_menu_image');
		$req->file('new_menu_image')->move('img/', $food_menu->id.'_'.$req->file('new_menu_image')->getClientOriginalName());
		$food_menu->img_name = $food_menu->id.'_'.$req->file('new_menu_image')->getClientOriginalName(); 
	    }
	    
	    $food_menu->save();
	    return redirect()->back();
	}
	else
	{
	     return redirect('/login');
	}
    }
    public function addRestaurantTable(Request $req, $id)
    {
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $rest = Restaurant::find($id);
	    if($rest->owner_id != Auth::user()->id)
	    {
		return redirect('/');
	    }
	    $this->validate($req, [
		'new_num_of_tables' => 'required|integer',
		'new_capacity' => 'required|integer',
		'new_booking_fee' => 'required|numeric'
	    ]) ;

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
	else
	{
	     return redirect('/login');
	}

    }
    public function updateRestaurantTable(Request $req, $table_id)
    {
	if(\Auth::check() && \Auth::user()->user_type == 1)
	{
	    $table = RestaurantTable::find($table_id);
	    $rest = Restaurant::find($table->restaurant_id);
	    if($rest->owner_id != Auth::user()->id)
	    {
		return redirect('/');
	    }
	    $this->validate($req, [
		'num_of_tables' => 'required|integer',
		'capacity' => 'required|integer',
		'booking_fee' => 'required|numeric'
	    ]) ;

	    $table->capacity = $req->input('capacity');
	    $table->booking_fee = $req->input('booking_fee');
	    $table->save();
	    return redirect()->back();
	}
	else
	{
	     return redirect('/login');
	}
    }
}
