@extends('layouts.app')

@section('title', 'Account')

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
	
		<form action="{{ url('/').'/account/'.Auth::user()->id.'/update' }}" method="POST">
			<input type="submit" value="Update">
		</form>

	</p>
</div>

@endsection