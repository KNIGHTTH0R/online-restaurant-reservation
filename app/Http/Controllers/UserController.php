<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Restaurant;

use Auth;

class UserController extends Controller
{
    //
    public function showAccount()
    {
	if(Auth::user()->user_type == 1)
	{
	    //return view('restaurantOwner.owner_account', ['restaurants' => Restaurant::all()]);
	    return view('account', ['restaurants' => Restaurant::all()]);
	}
	else
	{
	    return view('account');
	}
    }

    public function showUpdateAccount()
    {
	return view('/account_update');
    }

    public function updateAccount(Request $req)
    {
	$user = Auth::user();
	$this->validate($req, [
	    'contact' => 'required|numeric'
	]);
	$user->first_name = $req->input('first_name');
	$user->last_name = $req->input('last_name');
	$user->contact_number = $req->input('contact');
	$user->billing_address = $req->input('bill');
	$user->save();
	return redirect('/account');
    }
}
