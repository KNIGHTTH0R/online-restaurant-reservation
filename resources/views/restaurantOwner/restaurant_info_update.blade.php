@extends('layouts.app')

@section('title', 'Account Update')

@section('content')

<div class="container">
	<form action="{{ url('/').'/restaurant_info_update/'.$restaurants->id }}" method="POST" enctype="multipart/form-data" role="form">

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
						@if ($errors->has('location'))
                                    		<span class="help-block">
                                        		<strong>{{ $errors->first('location') }}</strong>
						</span>
						@endif

					</td>
				</tr>

				<tr>
					<td> <strong>Email:</strong></td>
					<td>
						<input type="text" id="email" name="email" value="{{ $restaurants->email }}" class="form-control">
						@if ($errors->has('email'))
                                    		<span class="help-block">
                                        		<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif


					</td>
				</tr>

				<tr>
					<td> <strong>Contact NO:</strong></td>
					<td>
						<input type="text" id="contact" name="contact" value="{{ $restaurants->contact_number }}" class="form-control">
						@if ($errors->has('contact'))
                                    		<span class="help-block">
                                        		<strong>{{ $errors->first('contact') }}</strong>
						</span>
						@endif

					</td>
				</tr>

				<tr>
					<td> <strong>Website:</strong></td>
					<td>
					    <input type="text" id="website" name="website" value="{{ $restaurants->website }}" class="form-control">
					    @if ($errors->has('website'))
                                    		<span class="help-block">
                                        		<strong>{{ $errors->first('website') }}</strong>
						</span>
						@endif


					</td>
				</tr>

				<tr>
					<td> <strong>Image:</strong></td>
					<td>
					<br>
					    <input type="file" name="image">	
					    @if ($errors->has('image'))
                                    		<span class="help-block">
                                        		<strong>{{ $errors->first('image') }}</strong>
						</span>
					    @endif

					<br>
					</td>

				</tr> 
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

	<form action="{{ url('/').'/restaurant_info_update/add_cuisine/'.$restaurants->id }}" method="POST" role="form">
	    <input type="hidden" name="_token" value = "{{ csrf_token() }}">
	    <p><br><br></p>

	    <h4> Add Cuisine </h4>
	    <br>

		<table>
			<thead>
				<tr>
					<th> Cuisine </th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>
						<select name="cuisine" class="form-control">
							<option value="none">Select Cuisine</option>
							@foreach($cuisines as $cuisine)
							<option value="{{ $cuisine->id }}">{{ $cuisine->cname }}</option>
							@endforeach
						</select>
					</td>
				</tr>
			</tbody>

		</table>
		<input type="submit" value="Add Cuisine">
	    
	</form>
	
		<p> <br> <br> </p>
		<h4> Update Existing Tables </h4>
		<br>

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
							@if ($errors->has('capacity'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('capacity') }}</strong>
							</span>
						@endif


						</td>
					
						<td>
							<input type="text" name="booking_fee" value="{{ $table->booking_fee }}" class="form-control">
							@if ($errors->has('booking_fee'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('booking_fee') }}</strong>
							</span>
						@endif	
						</td>
						<td>
							<input type="submit" value="Update">
						</td>

						</form>

						

						<td>
							<form action="{{ url('/').'/restaurant_info_update/delete_table/'.$table->id }}" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">
								<input type="submit" value="Delete">
							</form>

						</td>
					</tr>

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
	    <p><br><br></p>

	    <h4> Add Table </h4>
	    <br>

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
						@if ($errors->has('new_capacity'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('new_capacity') }}</strong>
							</span>
						@endif

					</td>
				
					<td>
						<input type="text"  name="new_booking_fee" class="form-control">
	
						@if ($errors->has('new_booking_fee'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('new_booking_fee') }}</strong>
							</span>
						@endif				
					</td>
					
					<td>
						<input type="text"  name="new_num_of_tables" class="form-control">
						
						@if ($errors->has('new_num_of_tables'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('new_num_of_tables') }}</strong>
							</span>
						@endif
					</td>
				</tr>
			</tbody>

		</table>
		<input type="submit" value="Add Table">
	    
	</form>
	    <p><br><br></p>

	    <h4> Update Food Menu </h4>
	    <br>

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
			    	<form action="{{ url('/').'/restaurant_info_update/update_food_menu/'.$menu->id }}" enctype="multipart/form-data" method="POST" role="form">
					<input type="hidden" name="_token" value = "{{ csrf_token() }}">
					<tr>
					<td>
						<input type="text" class="form-control" name="menu_name" value="{{ $menu->name  }}">
						@if ($errors->has('menu_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('menu_name') }}</strong>
							</span>
						@endif

					</td>
				
					<td>
						<input type="text" class="form-control" name="menu_price" value="{{ $menu->price }}">
						@if ($errors->has('menu_price'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('menu_price') }}</strong>
							</span>
						@endif

					</td>

					<td>
						<input type="text"  class="form-control" value={{ $menu->category }} class="field left" readonly>
					</td>

					<td>
						<input type="file" class="form-control" name="menu_image"/>
					</td>

					<td>
					  <input type="submit" value="Update Food Menu">
					</td>

					</form>

					<td>
						<form action="{{ url('/').'/restaurant_info_update/delete_food_menu/'.$menu->id }}"" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_method" value="DELETE">
							<input type="submit" value="Delete">
						</form>
					</td>

					</tr>

				@endforeach
			</tbody>

		</table>

	<form action="{{ url('/').'/restaurant_info_update/add_food_menu/'.$restaurants->id }}" enctype="multipart/form-data" method="POST" role="form">
	    <input type="hidden" name="_token" value = "{{ csrf_token() }}">
	    
	    <p><br><br></p>
	    <h4> Add Food Menu </h4>
	    <br>

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
						<input type="text"  name="new_menu_name" class="form-control">
						@if ($errors->has('new_menu_name'))
                            <span class="help-block">
                            	<strong>{{ $errors->first('new_menu_name') }}</strong>
							</span>
						@endif

					</td>
				
					<td>
						<input type="text"  class="form-control" name="new_menu_price">
						@if ($errors->has('new_menu_price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new_menu_price') }}</strong>
							</span>
						@endif
					</td>
					
					<td>
					    <select name="new_menu_category" class="form-control">
						<option value="Appetizer"> Appetizer </option>
						<option value="Main Course"> Main Course </option>
						<option value="Beverage  & Dessert"> Beverage & Dessert </option>
					    </select>

					</td>

					<td>

						<input type="file"  class="form-control" name="new_menu_image"/>

					</td>
				</tr>
			</tbody>

		</table>
		<input type="submit" value="Add Food Menu">
	    
	</form>

</div>

@endsection
