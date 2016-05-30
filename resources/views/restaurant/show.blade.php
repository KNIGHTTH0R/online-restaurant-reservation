@extends('layouts.app')

@section('title', $restaurant->name)
@section('extracss')
<link rel="stylesheet" href="{{ asset('css/scrolling-nav.css') }}">

@endsection
@section('content')
<!-- Intro Section -->
<section id="intro" class="intro-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>{{ $restaurant->name }}</h1>
				<!-- $$ Read from database -->
				<img src="{{ asset('img/'.$restaurant->img_name) }}" height="375px"/>
				<!-- $$ Read img src from database -->
			</div>
		</div>
	</div>
</section>

	<!-- Reserve Section -->
	<section id="reserve" class="reserve-section">
		<div class="container">
				<div class="row">
					<div class="col-lg-12">
			<h1> Reserve </h1>
			<div class="person-date-select"  style="display: inline-block">
			<form action="{{ url('book') }}" method="POST">
				{{ csrf_field() }}
			<div style="padding-top: 15px; display:inline-block">
				<select name="num-of-persons" class="form-control">
				<!-- $$ Read from database or hardcode? -->
				<option value="1">Reserve For 1</option>
				<option value="2">Reserve For 2</option>
				<option value="3">Reserve For 3</option>
				<option value="4">Reserve For 4</option>
				<option value="5">Reserve For 5</option>
				<option value="6">Reserve For 6</option>
				<option value="7">Reserve For 7</option>
				<option value="8">Reserve For 8</option>
				<option value="9">Reserve For 9</option>
				<option value="10">Reserve For 10</option>
			</select>
			</div>

			<div style="display:inline-block; margin-left: 15px">
			<!-- datepicker -->
			<div class="container" style="display:inline-block; width:70px">
				<div class="hero-unit" style="width:50px">
				<input  type="text" name="reservation-date" placeholder="choose date"  id="example1">
			</div>
		</div>
	</div>

	<div style="display:inline-block; margin-left:150px">
		<select name="reservation-time" class="form-control">
		<!-- $$ Read from database or hardcode? -->
			<option value="1">07:00PM</option>
			<option value="2">07:30PM</option>
			<option value="3">08:00PM</option>
			<option value="4">08:30PM</option>
			<option value="5">09:00PM</option>
			<option value="6">09:30PM</option>
			<option value="7">10:00PM</option>
		</select>
	</div>
	
	<div style="display:inline-block; margin-left: 30px">
		<button type="submit" class="btn-default btn-medium">Book Now!</button>
	</div>
	</form>

</div>
	</div>
	</div>
</div>
	</section>

	<!-- About Section, a brief overview of location, offered categories etc. and google map image -->

	<!-- $$ For example, for gloria jeans it can be like this:
	Gloria Jeans is a renowned restaurant located at <Address read from database>. We offer <Read from database> cuisines. etc.
	Actually this description should be provided by the restaurants themselves, but we dont have table in database to store these.
	So this way we can manage it -->

	<section id="about" class="about-section">
		<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h1>About Us</h1>
					<!-- $$ Show google map image-->
					<!--<div style="display: inline-block; margin-left: -120px">
						<p> show the google map image here and delete this line </p>
						<img src="img/Gloria_Jeans_Coffee.jpg" height="225px"/>
					</div>
					-->
					<!--
					<div style="display: inline-block; margin-left:50px; vertical-align: top-text">
						<p> {{ $restaurant->location }} </p>
					</div>
					-->
					<div style="margin-top: 30px">
						<p>{{ $restaurant->description }}</p>
					</div>

					</div>
				</div>
		</div>
	</section>

	<!-- Photos Section -->
	<section id="photos" class="photos-section">
		<div class="container" style="margin-top: -100px">
				<div class="row">
					<div class="col-lg-12">
					<h1> Photos </h1>
					<!-- $$ bring photos from database, not sure where to be added-->

					<div class="container" id="photos"  style="margin-left: 20%">
						<div class="row">
							<div class="box">
								<div class="col-lg-8 text-center">
									<div id="carousel-example-generic" class="carousel slide" data-interval="3000" data-ride="carousel">
										<!-- Indicators -->
										<ol class="carousel-indicators hidden-xs">
												<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
											@for($i = 1; $i < count($food_menus); $i++)
												<li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
											@endfor
										</ol>

										<!-- Wrapper for slides -->
										<div class="carousel-inner">

											@foreach($food_menus as $index => $menu)
											@if($index == 0)
											<div class="item active">
											@else
											<div class="item">
											@endif
													<img class="img-responsive img-full" src="{{ asset('img/'.$menu->img_name) }}" alt="">
													<div class="carousel-caption">
														<h3>{{ $menu->name }}</h3>
												</div>
												</div>
											@endforeach


										<!-- Controls -->

										<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
												<span class="icon-prev"></span>
										</a>

										<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
												<span class="icon-next"></span>
										</a>

									</div>

									<hr class="tagline-divider">

								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
		</div>
	</section>

	<section id="menu" class="menu-section">
		<div class="container">
		<!--Row with three equal columns-->
			<h1> Menu </h1>
			<div class="row">

				<div class="col-sm-4" style = "padding-left: 30px; padding-right: 30px">
					<div class="Most Popular Places">
						<h3>Appetizer</h3>
						<div class="row" style="height: 350px; overflow-y:scroll">
							<div class="col-sm-6" style="margin-top: 10px; text-align: left">
								<table>
									<!-- $$Read from database and use laravel for integration-->
									<thead>
										<tr>
											<h4> Item </h4>
										<tr>
									</thead>
									<tbody>
										@foreach($food_menus as $menu)
										@if($menu->category == "appetizer")
										<tr>
											<td>
												{{ $menu->name }}
											</td>
										</tr>
										@endif
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="col-sm-6" style="margin-top: 10px; text-align: right">
								<h4> Price </h4>
								<ul style="list-style-type: none">
									@foreach($food_menus as $menu)
										@if($menu->category == "appetizer")
											<li>
												{{ $menu->price }}/-
											</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="col-sm-4" style = "padding-left: 30px; padding-right: 30px">
					<div class="Most Popular Places">
						<h3>Main Course</h3>
						<div class="row" style="height: 350px; overflow-y:scroll">
							<div class="col-sm-6" style="margin-top: 10px; text-align: left">
								<table>
									<!-- $$Read from database and use laravel for integration-->
									<thead>
										<tr>
											<h4> Item </h4>
										<tr>
									</thead>
									<tbody>
										@foreach($food_menus as $menu)
										@if($menu->category == "main course")
										<tr>
											<td>
												{{ $menu->name }}
											</td>
										</tr>
										@endif
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="col-sm-6" style="margin-top: 10px; text-align: right">
								<h4> Price </h4>
								<ul style="list-style-type: none">
									@foreach($food_menus as $menu)
										@if($menu->category == "main course")
											<li>
												{{ $menu->price }}/-
											</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="col-sm-4" style = "padding-left: 30px; padding-right: 30px">
					<div class="Most Popular Places">
						<h3>Beverage  & Dessert</h3>
						<div class="row" style="height: 350px; overflow-y:scroll">
							<div class="col-sm-6" style="margin-top: 10px; text-align: left">
								<table>
									<!-- $$Read from database and use laravel for integration-->
									<thead>
										<tr>
											<h4> Item </h4>
										<tr>
									</thead>
									<tbody>
										@foreach($food_menus as $menu)
										@if($menu->category == "beverage and dessert")
										<tr>
											<td>
												{{ $menu->name }}
											</td>
										</tr>
										@endif
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="col-sm-6" style="margin-top: 10px; text-align: right">
								<h4> Price </h4>
								<ul style="list-style-type: none">
									@foreach($food_menus as $menu)
										@if($menu->category == "beverage and dessert")
											<li>
												{{ $menu->price }}/-
											</li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section id="rating" class="rating-section">
		<h1> Customer Reviews </h1>
		<div style="height: 300px; overflow-y:scroll; margin-left:20px; margin-right: 40px; padding-left:70px; padding-right:20px">
			<table class="table" style="margin-top: 25px">
				<!-- $$Read from database and use laravel for integration-->
				<thead>
					<tr>
						<th style="width: 15%"></th>
						<th style="width: 60%"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($reviews as $review)
					<tr>
						<td>
							<!--Read from database $$-->
							{{ $review['user_name'] }}
						</td>
						<td>
							<!--Read from database $$-->
							{{ $review['review_text'] }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection

@section('extrascripts')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function () {

				$('#example1').datepicker({
					format: "dd/mm/yyyy"
				});

		});
	</script>

	<!-- Scrolling Nav JavaScript -->
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/scrolling-nav.js"></script>

<!--	<script src="js/jquery-1.9.1.min.js"></script>-->
	
@endsection
