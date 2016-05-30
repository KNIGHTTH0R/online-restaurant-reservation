<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Restaurant;
use App\Food_Menu;
use App\Review;
use App\User;

class RestaurantController extends Controller
{
    //
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        $food_menus = Food_Menu::where('restaurant_id', '=', $restaurant->id)->get();
        $food_categories = Food_Menu::select('category')->where('restaurant_id', '=', $restaurant->id)->get();
        $reviews = Review::where('restaurant_id', '=', $restaurant->id)->get();
        
        $reviews = $reviews->map(function($item, $key) {
			$user_name = User::find($item->user_id)->user_name;
			$restaurant_name = Restaurant::find($item->restaurant_id)->name;
			return ['user_name' => $user_name, 'review_text' => $item->review_text, 'rating' => $item->rating];
		});
        
        return view('restaurant.show', ['restaurant' => $restaurant,'reviews' => $reviews, 'food_menus' => $food_menus, 'food_categories' => $food_categories]);
    } 
    public function showAll()
    {
    	$restaurants = Restaurant::all();
    	return view('restaurant.showall', ['restaurants' => $restaurants]);	
    }
    
    public function search(Request $request)
    {
    	$name = $request->input('name');
    	$location = $request->input('location');
    	$category = $request->input('category');
    	
    	$reservation_date = $request->input('reservation-date');
    	
    	$timeslot = $request->input('reservation-time');
    	$num_of_persons = $request->input('num-of-persons');
    	
    	$restaurants = null;
    	//$location = '%'.$location.'%';
    	//$name = '"%'.$name.'%"';
    	
    	if(strlen($location) == 0)
    	{
    		$location = '%';
    	}
    	if(strlen($name) == 0)
    	{
    		$name = '%';
    	}
    	if($category == 'none')
    	{
    		$category = '%';
        }
        //$name = '"'.$name.'"';

    	//return "%{$name}%";
    	//$restaurants = DB:select('select * from restaurants as r join offered_category as oc on r.id = oc.restaurant_id join restaurant_category as c on c.id = oc.category_id where r.name like ? or r.location like ? or c.category_name like ?', [$name, $location, $category]);
    	//$restaurants = Restaurant::where('name', 'like', $name)->get();
    	$restaurants = Restaurant::from('restaurant as r')
    	->join('offered_category as oc', 'r.id', '=', 'oc.restaurant_id')
    	->join('restaurant_category as c', 'c.id', '=', 'oc.category_id')
    	->where('r.name', 'LIKE', $name)
    	->where('r.location', 'LIKE', '%')
    	->where('c.category_name', 'LIKE', $category)
    	->get();
    	
    	//return $restaurants;
    	return view('restaurant.search', ['restaurants' => $restaurants]);
    }
}
