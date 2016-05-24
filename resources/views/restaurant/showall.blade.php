@extends('layouts.app')

@section('content')

<!-- Intro Section -->
	
	<div style="height: 300px; overflow-y:scroll; margin-left:20px; margin-right: 40px; padding-left:70px; padding-right:20px">
		<table style="margin-top: 25px; border:none">
			<!-- $$Read from database and use laravel for integration-->
			<tbody>
				@foreach($restaurants as $restaurant)
				<tr>
					<td style="padding-top: 1em; padding-bottom: 1em; padding-left: 1em; padding-right: 1em">
						<!--Image from database $$-->
						<img src="{{ asset('img/'.$restaurant->img_name) }}" height="50px"/>
					</td>
					<td style="padding-top: 1em; padding-bottom: 1em; padding-left: 1em; padding-right: 1em">
						<!--Name from database $$-->
						<a href="{{ url('restaurants/'.$restaurant->id) }}"> {{ $restaurant->name }} </a> <br>
						<!--Rating from database $$-->
						{{ $restaurant->rating }} <br>
						<!--Location from database $$-->
						{{ $restaurant->location }}
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>	
	


@endsection
