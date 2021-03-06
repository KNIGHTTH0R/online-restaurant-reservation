<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Review;
use App\User;
use App\Cuisine;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured = Restaurant::where('featured', true)->get();
	$reviews = Review::orderBy('created_at', 'desc')->where('review_text', '!=' ,'')->take(3)->get();
        $r_r = $reviews->map(function($item, $key) {
            $user_name = ($item->user_id == null ? "Anonymous" : User::find($item->user_id)->user_name);
            
            $restaurant_name = Restaurant::find($item->restaurant_id)->name;
            
            return ['user_name' => $user_name, 'restaurant_name' => $restaurant_name, 'review_text' => $item->review_text, 'rating' => $item->rating];
	});

	$popular = Restaurant::where('featured', true)->take(2)->get();
        return view('home', ['cuisines' => Cuisine::all(), 'popular_restaurants' => $popular, 'featured_restaurants' => $featured, 'recent_reviews' => $r_r]);
    }

    public function aboutus()
    {
        return view('aboutus');
    }

    public function termsofuse()
    {
        return view('termsofuse');
    }

    public function faq()
    {
        return view('faq');
    }

    public function contactus()
    {
        return view('contactus');
    }

    public function policy()
    {
        return view('policy');
    }

    public function howtobook()
    {
        return view('howto');
    }
}
