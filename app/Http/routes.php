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
    return view('welcome');
});

Route::get('/restaurants', function () {
    return "this will show list of all the restaurants";
});

Route::get('/about', function () {
    return "This is going to be our about us page";
});

Route::get('/howto', function() {
    return "This is going to be our how to book page";
});

Route::get('/FAQ', function() {
    return "This is going to be our FAQ page";
});
