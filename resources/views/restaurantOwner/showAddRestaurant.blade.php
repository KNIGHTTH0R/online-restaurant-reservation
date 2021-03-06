@extends('layouts.app')

@section('title', 'Add Restaurant')

@section('content')

<div class="container" id="add-restaurant-form">
    <div class="row">
	<div class="col-md-12">

	    	<form action="{{ url('/restaurantOwner/storeRestaurant') }}" method="POST" enctype="multipart/form-data" role="form">

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
						<input type="text" name="name" class="form-control">
						@if ($errors->has('name'))
                                    			<span class="help-block">
                                        			<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</td>
				</tr>
				
				<tr>
					<td><strong>Location:</strong></td>
					<td>
						<input type="text" name="location" class="form-control">
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
						<input type="text" name="email" class="form-control">
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
						<input type="text" name="Contact" class="form-control"/>
						@if ($errors->has('Contact'))
                                    			<span class="help-block">
                                        			<strong>{{ $errors->first('Contact') }}</strong>
							</span>
						@endif
					</td>
				</tr>

				<tr>
					<td> <strong>Website:</strong></td>
					<td>
					    <input type="text" name="website" class="form-control">
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
					    <input type="textarea" name="description" class="form-control">
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
