@extends('layouts.app')

@section('content')

<div class="container">

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
			<form action="{{ url('/').'/book/'.$restaurant_id }}" method="POST">
				{{ csrf_field() }}

				@foreach($available_tables as $available_table)
				<tr>
					<td>{{ $available_table->capacity }}</td>
					<td>{{ $available_table->id }}</td>
					<td>{{ $available_table->booking_fee }}</td>
					<td>
						<input type="checkbox" name="{{ 'check'.$available_table->id }}" value="{{ $available_table->id }}"> Book this table<br>
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
