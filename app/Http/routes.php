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
    return view('home', ['restaurant_categories' => App\Restaurant_Category::all()]);
});

Route::get('/restaurants', function () {
    return App\Restaurant::all();
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/search', 'RestaurantController@search');
