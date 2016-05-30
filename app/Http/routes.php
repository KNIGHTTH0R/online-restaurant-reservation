<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Input;

Route::get('/', function () {
	$featured = App\Restaurant::where('featured', true)->get();
	$reviews = App\Review::orderBy('created_at', 'desc')->take(3)->get();
    $r_r = $reviews->map(function($item, $key) {
        if($item->user_id == null)
        {
            $user_name = "Anonymous";
        }
        else
        {
    		$user_name = App\User::find($item->user_id)->user_name;
        }    
        $restaurant_name = App\Restaurant::find($item->restaurant_id)->name;
		return ['user_name' => $user_name, 'restaurant_name' => $restaurant_name, 'review_text' => $item->review_text, 'rating' => $item->rating];
	});
	
    return view('home', ['restaurant_categories' => App\Restaurant_Category::all(), 'featured_restaurants' => $featured, 'recent_reviews' => $r_r]);
});

Route::get('/', 'HomeController@index');

Route::get('/restaurants', 'RestaurantController@showall');

Route::get('/restaurants/{id}', 'RestaurantController@show');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/search', 'RestaurantController@search');

Route::get('/account', function () {
	return view('account');
});

Route::get('/account/update', function(){
    return view('account_update');
});

Route::put('/account', function(){
    $user = Auth::user();
    $user->first_name = Input::get('first_name');
    $user->last_name = Input::get('last_name');
    $user->contact_number = Input::get('contact');
    $user->billing_address = Input::get('bill');
    $user->save();

    return redirect('/account');
});

Route::get('/restaurantOwner/addRestaurant', 'RestaurantOwnerController@showAddRestaurant');

Route::post('/restaurantOwner/storeRestaurant', 'RestaurantOwner@storeRestaurant');

Route::post('book', 'BookingController@book');
