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

Route::get('/', function () {
	$featured = App\Restaurant::where('featured', true)->get();
	$reviews = App\Review::orderBy('created_at', 'desc')->take(3)->get();
	$r_r = $reviews->map(function($item, $key) {
		$user_name = App\User::find($item->user_id)->user_name;
		$restaurant_name = App\Restaurant::find($item->restaurant_id)->name;
		return ['user_name' => $user_name, 'restaurant_name' => $restaurant_name, 'review_text' => $item->review_text, 'rating' => $item->rating];
	});
	
    return view('home', ['restaurant_categories' => App\Restaurant_Category::all(), 'featured_restaurants' => $featured, 'recent_reviews' => $r_r]);
});

Route::get('/restaurants', 'RestaurantController@showall');

Route::get('/restaurants/{id}', 'RestaurantController@show');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/search', 'RestaurantController@search');

Route::get('/account', function () {
	return view('account');
});
