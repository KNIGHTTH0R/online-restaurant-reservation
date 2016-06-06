@extends('layouts.app')

@section('title', 'Add Restaurant')

@section('content')

<div class="container" id="add-restaurant-form">
    <div class="row">
	<div class="col-md-12">

	    	<form action="{{ url('/restaurantOwner/storeRestaurant') }}" method="POST" enctype="multipart/form-data">

		<input type="hidden" name="_token" value = "{{ csrf_token() }}">
		
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
					<td><strong>Name:</strong></td>
					<td>
						<input type="text" name="name">
					</td>
				</tr>
				
				<tr>
					<td><strong>Location:</strong></td>
					<td>
						<input type="text" name="location">
					</td>
				</tr>

				<tr>
					<td> <strong>Email:</strong></td>
					<td>
						<input type="text" name="email">
					</td>
				</tr>

				<tr>
					<td> <strong>Contact NO:</strong></td>
					<td>
						<input type="text" name="contactno"/>
					</td>
				</tr>

				<tr>
					<td> <strong>Website:</strong></td>
					<td>
					    <input type="text" name="website"/>
					</td>
				</tr>
				
				<tr>
					<td> <strong>Image:</strong></td>
					<td>
					    <input type="file" name="image"/>
					</td>
				</tr>
				
				<tr>
					<td> <strong>Description:</strong></td>
					<td>
					    <input type="text" name="description"/>
					</td>
				</tr>
   			</tbody>

		</table>

		<input type="submit" value="Add">
	    </form>
	</div>
    </div>
</div>


@endsection
