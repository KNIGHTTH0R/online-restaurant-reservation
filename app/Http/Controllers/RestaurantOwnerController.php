<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
    
    public function storeRestaurant()
    {
        $parking = (isset(
        $restaurant = new App\Restaurant;
        $restaurant->name = Input::get('name');
        $restaurant->location = Input::get('location');
        $restaurant->email = Input::get('email');
        $restaurant->contact_number = Input::get('contactno');
        $restaurant->website = Input::get('website');
        $restaurant->description = Input::get('description');
    }

}
