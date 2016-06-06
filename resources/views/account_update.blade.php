@extends('layouts.app')

@section('title', 'Account Update')

@section('content')

<div class="container">
	<form action="{{ url('/').'/account' }}" method="POST" role="form">

		<input type="hidden" name="_token" value = "{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		
		<div class="form-group">
	      	<label for="usr">First Name:</label>
	      	<input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control">
	    </div>

	    <div class="form-group">
	      	<label for="usr">Last Name:</label>
	      	<input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control">
	    </div>

	    <div class="form-group">
	      	<label for="usr">Contact No:</label>
		<input type="text" id="contact" name="contact" value="{{ Auth::user()->contact_number }}" class="form-control">
			@if ($errors->has('contact'))
				<span class="help-block">
                                <strong>{{ $errors->first('contact') }}</strong>
				</span>
			@endif
	    </div>

	    <div class="form-group">
	      	<label for="usr">Billing Address:</label>
	      	<input type="text" id="bill" name="bill" value="{{ Auth::user()->billing_address }}" class="form-control">
	    </div>

		<p></p>
		<p>
			<input type="submit" value="Update">
		</p>
	</form>
</div>

@endsection
