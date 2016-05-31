@extends('layouts.app')

@section('title', 'Account Update')

@section('content')

<div class="container">
	<form action="{{ url('/').'/account' }}" method="POST">

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
					<td><strong>First Name:</strong></td>
					<td>
						<input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}">
					</td>
				</tr>

				<tr>
					<td> <strong>Last Name:</strong></td>
					<td>
						<input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}">
					</td>
				</tr>

				<tr>
					<td> <strong>Contact NO:</strong></td>
					<td>
						<input type="text" id="contact" name="contact" value="{{ Auth::user()->contact_number }}"/>
					</td>
				</tr>

				<tr>
					<td> <strong>Billing Address:</strong></td>
					<td>
					    <input type="text" id="bill" name="bill" value="{{ Auth::user()->billing_address }}"/>
					</td>
				</tr>

			</tbody>

		</table>

		<p></p>
		<p>
			<input type="submit" value="Update">
		</p>
	</form>
</div>

@endsection
