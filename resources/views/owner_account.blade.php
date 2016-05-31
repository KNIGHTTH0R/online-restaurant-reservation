@extends('layouts.app')

@section('title', 'Owner Account')

@section('content')

<div class="container">
	<table>
		<col width="120">
  		<col width="120">

		<thead>
			<tr>
				<th></th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td> <strong>User Name:</strong> </td>
				<td> {{ Auth::user()->user_name }}</td>
			</tr>

			<tr>
				<td><strong>Email:</strong></td>
				<td>{{ Auth::user()->email }} </td>
			</tr>

			<tr>
				<td> <strong>First Name:</strong></td>
				<td>{{ Auth::user()->first_name }}</td>
			</tr>

			<tr>
				<td> <strong>Last Name:</strong></td>
				<td>{{ Auth::user()->last_name }}</td>
			</tr>

			<tr>
				<td> <strong>Contact NO:</strong></td>
				<td>{{ Auth::user()->contact_number }}</td>
			</tr>

			<tr>
				<td> <strong>Billing Address:</strong></td>
				<td>{{ Auth::user()->billing_address }}</td>
			</tr>

		</tbody>
	</table>

	<p>
		<a href="{{ url('/').'/account/update' }}"> <h4>Update</h4> </a>
	</p>

	<p> <br> </p>
	<p>
		<a href="{{ url('/').'/restaurantOwner/addRestaurant' }}"> <h4>Add a Restaurant</h4> </a>
	</p>	
	<h4> List of my Restaurants </h4>
	<div style="height: 300px; overflow-y:scroll; margin-left:20px; margin-right: 40px; padding-left:70px; padding-right:20px">
		<table style="margin-top: 25px; border:1px solid black">
			<!-- $$Read from database and use laravel for integration-->
			<tbody>
				@foreach($restaurants as $restaurant)
				@if ($restaurant->owner_id == Auth::user()->id)
				<tr>
					<td style="padding-top: 1em; padding-bottom: 1em; padding-left: 1em; padding-right: 1em">
						<!--Image from database $$-->
						<img src="{{ asset('img/'.$restaurant->img_name) }}" height="50px"/>
					</td>
					<td style="padding-top: 1em; padding-bottom: 1em; padding-left: 1em; padding-right: 1em">
						<!--Name from database $$-->
						<a href="{{ url('restaurants/'.$restaurant->id) }}"> {{ $restaurant->name }} </a> <br>
						<!--Rating from database $$-->
						{{ $restaurant->rating }} <br>
						<!--Location from database $$-->
						{{ $restaurant->location }}
					</td>
					<td>
						<a href="{{ url('/').'/restaurant_info_update'.$restaurant->id }}"> <h4>Update</h4> </a>
					</td>
				</tr>
				@endif
				@endforeach
				
			</tbody>
		</table>
	</div>
</div>

@endsection
