@extends('layouts.app')

@section('title', 'Account Update')

@section('content')

<div class="container">
	<form action="{{ url('/').'/restaurant_info_update/'.$restaurants->id }}" method="POST" role="form">

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
					<td><strong>Name:</strong></td>
					<td>
						<p>{{ $restaurants->name  }}</p>
					</td>
				</tr>
				
				<tr>
					<td><strong>Location:</strong></td>
					<td>
						<input type="text" id="location" name="location" value="{{ $restaurants->location }}" class="form-control">
					</td>
				</tr>

				<tr>
					<td> <strong>Email:</strong></td>
					<td>
						<input type="text" id="email" name="email" value="{{ $restaurants->email }}" class="form-control">
					</td>
				</tr>

				<tr>
					<td> <strong>Contact NO:</strong></td>
					<td>
						<input type="text" id="contact" name="contact" value="{{ $restaurants->contact_number }}" class="form-control">
					</td>
				</tr>

				<tr>
					<td> <strong>Website:</strong></td>
					<td>
					    <input type="text" id="website" name="website" value="{{ $restaurants->website }}" class="form-control">
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
					    <input type="textarea" id="desc" name="desc" value="{{ $restaurants->description }}" class="form-control">
					</td>
				</tr>
   			</tbody>

		</table>

		<input type="submit" value="Update">
	</form>
	
		<p> <br> <br> </p>
		<h4> Update Existing Tables </h4>
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
				@foreach ($restaurant_tables as $table)
			    	<form action="{{ url('/').'/restaurant_info_update/update_table/'.$table->id }}" method="POST" role="form">
					<input type="hidden" name="_token" value = "{{ csrf_token() }}">
					<tr>
						<td>
							<input type="text" name="capacity" value="{{ $table->capacity }}" class="form-control">
						</td>
					
						<td>
							<input type="text" name="booking_fee" value="{{ $table->booking_fee }}" class="form-control">
						</td>
						<td>
							<input type="submit" value="Update">
						</td>
					</tr>
				</form>
				@endforeach
			</tbody>

		</table>
<!--
		<p></p>
		<p>
			<input type="submit" value="Update Tables">
		</p>
-->
	
	<form action="{{ url('/').'/restaurant_info_update/add_table/'.$restaurants->id }}" method="POST" role="form">
	    <input type="hidden" name="_token" value = "{{ csrf_token() }}">
	    
	    <h4> Add Table </h4>
		<table>
			<col width="120">
	  		<col width="120">

			<thead>
				<tr>
					<th> Capacity </th>
					<th> Booking Fee</th>
					<th> Number of Tables </th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>
						<input type="text"  name="new_capacity" class="form-control">
					</td>
				
					<td>
						<input type="text"  name="new_booking_fee" class="form-control">
					</td>
					
					<td>
						<input type="text"  name="new_num_of_tables" class="form-control">
					</td>
				</tr>
			</tbody>

		</table>
		<input type="submit" value="Add Table">
	    
	</form>
	    
	    <h4> Update Food Menu </h4>
		<table>
			<col width="120">
	  		<col width="120">

			<thead>
				<tr>
				        <th> Menu Name </th>
					<th> Price </th>
					<th> Category </th>
				</tr>
			</thead>

			<tbody>
				<!-- Restaurant id has to be passed from controller/prev page -->
				@foreach ($food_menus as $menu)
			    	<form action="{{ url('/').'/restaurant_info_update/update_food_menu/'.$menu->id }}" enctype="multipart/form-data" method="POST">
					<input type="hidden" name="_token" value = "{{ csrf_token() }}">
					<tr>
					<td>
						<input type="text" name="menu_name" value="{{ $menu->name  }}">
					</td>
				
					<td>
						<input type="text" name="menu_price" value="{{ $menu->price }}">
					</td>
					
					<td>
					    <select name="menu_category" class="form-control">
						<option value="Appetizer"> Appetizer </option>
						<option value="Main Course"> Main Course </option>
						<option value="Beverage  & Dessert"> Beverage  & Dessert </option>
					    </select>

					</td>

					<td>
						<input type="file" name="menu_image"/>
					</td>
					<td>
					  <input type="submit" value="Update Food Menu">

					</tr>
				</form>
				@endforeach
			</tbody>

		</table>

	<form action="{{ url('/').'/restaurant_info_update/add_food_menu/'.$restaurants->id }}" enctype="multipart/form-data" method="POST">
	    <input type="hidden" name="_token" value = "{{ csrf_token() }}">
	    
	    <h4> Add Food Menu </h4>
		<table>
			<col width="120">
	  		<col width="120">

			<thead>
				<tr>
					<th> Menu Name </th>
					<th> Price </th>
					<th> Category </th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>
						<input type="text"  name="new_menu_name">
					</td>
				
					<td>
						<input type="text"  name="new_menu_price">
					</td>
					
					<td>
					    <select name="new_menu_category" class="form-control">
						<option value="Appetizer"> Appetizer </option>
						<option value="Main Course"> Main Course </option>
						<option value="Beverage  & Dessert"> Beverage  & Dessert </option>
					    </select>

					</td>

					<td>
						<input type="file" name="new_menu_image"/>

					</td>
				</tr>
			</tbody>

		</table>
		<input type="submit" value="Add Food Menu">
	    
	</form>

</div>

@endsection
