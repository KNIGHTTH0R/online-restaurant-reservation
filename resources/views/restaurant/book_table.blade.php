@extends('layouts.app')

@section('content')


BOOK TABLE

<div class="container">

	<table class="table">
		<col width="120">
	  	<col width="120">
	  	<col width="120">

		<thead>
			<tr>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>	

		<tbody>
			<tr>
				@foreach($available_tables as $available_table)
				<td>{{ $available_table->capacity }}</td>
				<td>{{ $available_table->id }}</td>
				<td>{{ $available_table->booking_fee }}</td>
				@endforeach
			</tr>
		</tbody>	
	</table>
	
</div>
