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
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use App\Restaurant;
use App\RestaurantTable;

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');


Route::post('/search', 'RestaurantController@search');

Route::get('/restaurants', 'RestaurantController@showall');

Route::get('/restaurants/{id}', 'RestaurantController@show');

Route::post('/restaurants/{id}/give_review', 'RestaurantController@storeReview');

Route::auth();

Route::get('/account', 'UserController@showAccount');
Route::get('/account/update', 'UserController@showUpdateAccount');
Route::put('/account', 'UserController@updateAccount');

Route::get('/restaurantOwner/addRestaurant', 'RestaurantOwnerController@showAddRestaurant');

Route::post('/restaurantOwner/storeRestaurant', 'RestaurantOwnerController@storeRestaurant');

Route::get('restaurant_info_update/{id}', 'RestaurantOwnerController@showUpdateRestaurant');
Route::put('restaurant_info_update/{id}', 'RestaurantOwnerController@updateRestaurant');

Route::post('/restaurant_info_update/add_table/{id}', 'RestaurantOwnerController@addRestaurantTable');

Route::post('/restaurant_info_update/add_cuisine/{id}', 'RestaurantOwnerController@addCuisine');

Route::post('/restaurant_info_update/update_table/{table_id}', 'RestaurantOwnerController@updateRestaurantTable');

Route::post('/restaurant_info_update/add_food_menu/{id}', 'RestaurantOwnerController@addFoodMenu');

Route::post('/restaurant_info_update/update_food_menu/{menu_id}', 'RestaurantOwnerController@updateFoodMenu');

Route::post('book', 'BookingController@book');

Route::delete('/restaurant_info_update/delete_table/{id}', 'RestaurantOwnerController@deleteRestaurantTable');

Route::delete('/restaurant_info_update/delete_food_menu/{id}', 'RestaurantOwnerController@deleteFoodMenu');
