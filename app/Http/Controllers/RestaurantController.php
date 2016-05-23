<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Restaurant;

class RestaurantController extends Controller
{
    //
    
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
    	//$restaurants = Restaurant::where('name', 'LIKE', $name)->where('location', 'LIKE', $location);
    	$restaurants = Restaurant::from('restaurant as r')
    	->join('offered_category as oc', 'r.id', '=', 'oc.restaurant_id')
    	->join('restaurant_category as c', 'c.id', '=', 'oc.category_id')
    	->where('r.name', 'LIKE', $name)
    	->where('r.location', 'LIKE', $location)
    	->where('c.category_name', 'LIKE', $category)
    	->get();
    	
    	//return $restaurants;
    	return view('restaurant.search', ['restaurants' => $restaurants]);
    }
}
