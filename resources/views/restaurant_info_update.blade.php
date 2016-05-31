@extends('layouts.app')

@section('title', 'Account Update')

@section('content')

<div class="container">
	<form action="{{ url('/').'/restaurant_info_update'.$restaurant->id }}" method="POST">

		<input type="hidden" name="_token" value = "{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		
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
					<td><strong>Location:</strong></td>
					<td>
						<input type="text" id="location" name="location" value="{{ $restaurants->location }}">
					</td>
				</tr>

				<tr>
					<td> <strong>Email:</strong></td>
					<td>
						<input type="text" id="email" name="email" value="{{ $restaurants->email }}">
					</td>
				</tr>

				<tr>
					<td> <strong>Contact NO:</strong></td>
					<td>
						<input type="text" id="contact" name="contact" value="{{ $restaurants->contact_number }}"/>
					</td>
				</tr>

				<tr>
					<td> <strong>Website:</strong></td>
					<td>
					    <input type="text" id="website" name="website" value="{{ $restaurants->website }}"/>
					</td>
				</tr>
				<!-- how to do this?
				<tr>
					<td> <strong>Image:</strong></td>
					<td>
					    <input type="text" id="image" name="image" value="{{ $restaurants->img_name }}"/>
					</td>
				</tr> -->
				<tr>
					<td> <strong>Description:</strong></td>
					<td>
					    <input type="text" id="desc" name="desc" value="{{ $restaurants->description }}"/>
					</td>
				</tr>

			</tbody>

		</table>
		<p> <br> <br> </p>
		<h4> Table Info </h4>
		<table>
			<col width="120">
	  		<col width="120">

			<thead>
				<tr>
					<th> Capacity </th>
					<th> Booking Fee</th>
				</tr>
			</thead>

			<tbody>
				<!-- Restaurant id has to be passed from controller/prev page -->
				@foreach ($restaurant_tables as table)
					@if ($table->restaurant_id == restaurant_id)
					<tr>
						<td>
							<input type="text" id= "{{ 'capacity_'.$table->id }}" name="{{ 'capacity_'.$table->id }}" value="{{ $table->capacity }}">
						</td>
					
						<td>
							<input type="text" id="{{ 'booking_fee_'.$table->id }}" name="{{ 'booking_fee_'.$table->id }}" value="{{ $table->booking_fee }}">
						</td>
					</tr>
					@endif
				@endforeach
			</tbody>

		</table>

		<p></p>
		<p>
			<input type="submit" value="Update">
		</p>
	</form>
</div>

@endsection
