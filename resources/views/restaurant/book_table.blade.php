@extends('layouts.app')

@section('content')

<div class="container">
	<!-- <form action="{{ url('/').'/book/'.$restaurant_id }}" method="POST">
				{{ csrf_field() }} -->
	<form action="{{ url('/payment') }}" method="POST">
	<h4> Suitable Tables </h4>
	<table class="table">
		<col width="120">
	  	<col width="120">
	  	<col width="120">
	  	
		<thead>
			<tr>
				<th>Capacity </th>
				<th>id </th>
				<th>fee </th>
				<th></th>
			</tr>
		</thead>	

		<tbody>

			<!--<form action="{{ url('/').'/book/'.$restaurant_id }}" method="POST">-->
			
				{{ csrf_field() }}
				<input type="hidden" name="timeslot" value="{{ $timeslot }}">
				<input type="hidden" name="reservation_date" value="{{ $reservation_date }}">
				<input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">

			
				@foreach($suitable_tables as $suitable_table)
				<tr>
					<td>{{ $suitable_table->capacity }}</td>
					<td>{{ $suitable_table->id }}</td>
					<td>{{ $suitable_table->booking_fee }}</td>
					<td>
						<input type="checkbox" name="{{ 'check'.$suitable_table->id }}" value="{{ $suitable_table->id }}"> Book this table<br>
					</td>
				</tr>
				@endforeach

		</tbody>	
	</table>

	<h4> Other Free Tables </h4>
	<table class="table">
		<col width="120">
	  	<col width="120">
	  	<col width="120">
	  	
		<thead>
			<tr>
				<th>Capacity </th>
				<th>id </th>
				<th>fee </th>
				<th></th>
			</tr>
		</thead>	

		<tbody>
		
				@foreach($other_free_tables as $other_free_table)

				<tr>
					<td>{{ $other_free_table->capacity }}</td>
					<td>{{ $other_free_table->id }}</td>
					<td>{{ $other_free_table->booking_fee }}</td>
					<td>
						<input type="checkbox" name="{{ 'check'.$other_free_table->id }}" value="{{ $other_free_table->id }}"> Book this table<br>
					</td>
				</tr>
				@endforeach

		</tbody>	
	</table>

	<p><br></p>
	
		<input type="submit" value="Submit">

	</form>	

</div>


@endsection
