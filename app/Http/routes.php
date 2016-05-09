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
    return view('home');
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

Route::get('termsofuse', function() {
    return "This is going to be our Terms of use page";
});

Route::get('policy', function() {
    return "This is going to be our policy page";
});

Route::get('contactus', function() {
    return "This is going to be our contact us page";
});

Route::get('login', function() {
    return "This is going to be our login page";
});

Route::get('signup', function() {
    return "This is going to be our signup page";
});
