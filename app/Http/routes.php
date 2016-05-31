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

Route::get('/restaurants', 'RestaurantController@showall');

Route::get('/restaurants/{id}', 'RestaurantController@show');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::post('/search', 'RestaurantController@search');

Route::get('/account', function () {
	if(Auth::user()->user_type == 1)
	{
	    return view('owner_account', ['restaurants' => Restaurant::all()]);
	}
	else
	{
	    return view('account');
	}
});

Route::get('restaurant_info_update/{id}', function(Request $req, $id) {
    $rest = Restaurant::find($id);
    $tables = RestaurantTable::where('restaurant_id', '=', $id)->get();
    return view('restaurant_info_update', ['restaurants' => $rest, 'restaurant_tables' => $tables]);
});

Route::put('restaurant_info_update/{id}', function(Request $req, $id)
{
    $rest = Restaurant::find($id);
    $rest->location = $req->input('location');
    $rest->email = $req->input('email');
    $rest->contact_number = $req->input('contact');
    $rest->website = $req->input('website');
    $rest->description = $req->input('desc');
    $rest->save();
    return redirect('/account');
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
Route::post('/restaurantOwner/storeRestaurant', 'RestaurantOwnerController@storeRestaurant');


/*
Route::post('/restaurantOwner/storeRestaurant', function (Request $req)
    {
        //$parking = (isset(
        $restaurant = new App\Restaurant;
        $restaurant->name = $req->input('name');
        $restaurant->location = $req->input('location');
        $restaurant->email = $req->input('email');
        $restaurant->contact_number = $req->input('contactno');
        $restaurant->website = $req->input('website');
	$restaurant->description = $req->input('description');
	return redirect('/account');
    }
);
 */
Route::post('book', 'BookingController@book');
