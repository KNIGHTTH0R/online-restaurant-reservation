<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

use App\Http\Requests;

use DB;

use Auth;
use Config;
use Session;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\RestaurantTable;
use App\Reservation;
use App\Reservation_Table;

class BookingController extends Controller
{
    //
    	public function book(Request $req)
    	{
		$rest_id = $req->input('restaurant-id');
		$num_of_persons =  $req->input('num-of-persons');
		//$reservation_date =  date_format(date_create_from_format('d/m/Y', $req->input('reservation-date')),"Y-m-d");
		$reservation_date = $req->input('reservation_date');		
		$reservation_time =  $req->input('reservation_time');
		

		///Do query here
		$available_tables = DB::select('select * from restaurant_table where capacity >= ?  and restaurant_id = ? and id not in (select distinct rt.table_number from reservation rv join reservation_table rt on rv.id = rt.reservation_id where rv.reservation_date = ? and rv.reservation_time_slot = ?)', [$num_of_persons, $rest_id, $reservation_date, $reservation_time]);

		return view('restaurant.book_table', ['available_tables' => $available_tables, 'restaurant_id' => $rest_id, 'timeslot' => $req->input('reservation_time'), 'reservation_date' => $req->input('reservation_date')]);
    	}

    	public function reserveTables(Request $req){
		foreach ($req->all() as $key => $value) {
		 	if($key == "_token");
		 	else{
		 		
		 	}
		}
   	}

	private $_api_context;		///

	public function __construct()	///
	{
		// setup PayPal api context
		$paypal_conf = Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);

	}
	
	public function postPayment(Request $req)
	{

	    $payer = new Payer();		///
	    $payer->setPaymentMethod('paypal'); ///
		$table_ids = array();
	    /// item and amount may be modified
	    $item_array = array();
	    $totalFee = 0.0;
	    //return $req;
	    foreach ($req->all() as $key => $value) {
	 	if(substr($key, 0, 5) === "check"){
	 		$item = new Item();
			//return $value;
			$rest_table = RestaurantTable::find($value);
			$item->setName("Table ID: ".$value." ; Capacity: ".$rest_table->capacity)
			->setQuantity(1)
			->setCurrency('USD')
			->setPrice($rest_table->booking_fee);
			array_push($item_array, $item);
			array_push($table_ids, $value);
			Session::put('table'.$value, $value);
			$totalFee += $rest_table->booking_fee;
	 	}
		//echo $totalFee;
	    }
		
	    //Session::put('old_request', $req);
		Session::put('tables', $table_ids);
		Session::put('timeslot', $req->timeslot);
		Session::put('reservation_date', $req->reservation_date);
		Session::put('total_fee', $totalFee);
		Session::put('restaurant_id', $req->restaurant_id);
		/*
	    $item_1 = new Item();
	    $item_1->setName('Item 1') // item name
		->setCurrency('USD')
		->setQuantity(2)
		->setPrice(15); // unit price

	    $item_2 = new Item();
	    $item_2->setName('Item 2')
		->setCurrency('USD')
		->setQuantity(4)
		->setPrice(7);

	    $item_3 = new Item();
	    $item_3->setName('Item 3')
		->setCurrency('USD')
		->setQuantity(1)
		->setPrice(20);
		*/
	    // add item to list
	    $item_list = new ItemList();	///
	    $item_list->setItems($item_array);

	    $amount = new Amount();	///
	    $amount->setCurrency('USD')
		->setTotal($totalFee);		

	    $transaction = new Transaction();	///
	    $transaction->setAmount($amount)	///
		->setItemList($item_list)	///
		->setDescription('Your transaction description');	///

	    $redirect_urls = new RedirectUrls();	///
	    $redirect_urls->setReturnUrl(URL::route('payment.status'))	///
		->setCancelUrl(URL::route('payment.status'));		///

	    $payment = new Payment();	///
	    $payment->setIntent('Sale')	///
		->setPayer($payer)	///
		->setRedirectUrls($redirect_urls)	///
		->setTransactions(array($transaction));	///

	    try {	///
		$payment->create($this->_api_context);
	    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
		if (\Config::get('app.debug')) {	
		    echo "Exception: " . $ex->getMessage() . PHP_EOL;
		    $err_data = json_decode($ex->getData(), true);
		    exit;
		} else {
		    die('Some error occur, sorry for inconvenient');
		}
	    }

	    foreach($payment->getLinks() as $link) {	///
		if($link->getRel() == 'approval_url') {
		    $redirect_url = $link->getHref();
		    break;
		}
	    }

	    // add payment ID to session
	    Session::put('paypal_payment_id', $payment->getId());	///
		
	    if(isset($redirect_url)) {	///
		// redirect to paypal
		return Redirect::away($redirect_url);
	    }

	    return redirect(url('/'))
		->with('error', 'Unknown error occurred');	/// redirect back to the suitable page if error occurs
	}
	













	public function getPaymentStatus()
	{
	    // Get the payment ID before session clear
	    //$old_req = Session::get('old_request');
	    
	    //Session::forget('old_req');

	    $payment_id = Session::get('paypal_payment_id');	///
	    $reservation_date = Session::get('reservation_date');
	    Session::forget('reservation_id');
	    $timeslot = Session::get('timeslot');
	    Session::forget('timeslot');
	    $table_ids = Session::get('tables');
	    Session::forget('tables');
	    // clear the session payment ID
	    Session::forget('paypal_payment_id');	///
	    $total_fee = Session::get('total_fee');
	    Session::forget('total_fee');
	    $restaurant_id = Session::get('restaurant_id');
	    Session::forget('restaurant_id');
	    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
		return redirect(url('/'))	/// redirect where? set it
		    ->with('error', 'Payment failed');		///
	    }
	    $reservation = new Reservation();
	    $reservation->reservation_fee = $total_fee;
	    $reservation->reservation_date = $reservation_date;
	    $reservation->reservation_time_slot = $timeslot;
	    $reservation->user_id = Auth::user()->id;

	    $reservation->save();

	    foreach($table_ids as $key => $value)
	    {
		$reservation_table = new Reservation_Table();
		$reservation_table->restaurant_id = $restaurant_id;
		$reservation_table->table_number = $value;
		$reservation_table->reservation_id = $reservation->id;
		$reservation_table->save();
	    }
	
 

	

	    $payment = Payment::get($payment_id, $this->_api_context);	///

	    // PaymentExecution object includes information necessary 
	    // to execute a PayPal account payment. 
	    // The payer_id is added to the request query parameters
	    // when the user is redirected from paypal back to your site
	    $execution = new PaymentExecution();	///
	    $execution->setPayerId(Input::get('PayerID'));	///
	    
	    //Execute the payment
	    $result = $payment->execute($execution, $this->_api_context);	///

	    //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

	    if ($result->getState() == 'approved') { // payment made
		/// save suitable info	[reservation object, reservation_table object]	
		return redirect(url('/'))	/// payment successful, show hashvalue of reservation id
		    ->with('success', 'Payment success');
	    }
	    return redirect(url('/'))		///
		->with('error', 'Payment failed');	///
	}
}
