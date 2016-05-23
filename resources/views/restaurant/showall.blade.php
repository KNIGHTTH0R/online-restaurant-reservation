@extends('layouts.app')

@section('content')
<div>
	<ul>
		@foreach($restaurants as $restaurant)
			<li>
				{{ $restaurant->name }}			
			</li>
		@endforeach	
	</ul>
</div>

@endsection
