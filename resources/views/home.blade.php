@extends('layouts.app')

@section('title', 'Home')

@section('content')
	
<!-- Number of persons -->
<form action="{{ url('search') }}" method="POST">
	{{ csrf_field() }}
	
	<div class="person-date-select"  style="padding-left: 150px; display: inline-block;">
   	<div style="display:inline-block">
			<select name="num-of-persons" class="form-control">
				<option value="1">Reserve For 1</option>
				<option value="2">Reserve For 2</option>
				<option value="3">Reserve For 3</option>
				<option value="4">Reserve For 4</option>
				<option value="5">Reserve For 5</option>
       	</select>
    	</div>
			
    	<div style="display:inline-block;">
    <!-- datepicker -->
			<div class="container" style="display:inline-block; width:180px">
            <div class="hero-unit" style="width:180px">
					<input  type="text" name="reservation-date" placeholder="choose date"  id="example1">
	    		</div>
			</div>
    	</div>
	</div>
		
		<!-- time selection -->
	<div style="display:inline-block;">
		<select name="reservation-time" class="form-control">
			<option value="1">07:00PM</option>
			<option value="2">07:30PM</option>
			<option value="3">08:00PM</option>
			<option value="4">08:30PM</option>
			<option value="5">09:00PM</option>
		</select>	
	</div>
		
		<!-- Input restaurant name -->
	<div class="form-group" style="display:inline-block">
		<input type="text" name="name" style="display:inline-block" class="form-control" id="restaurant-name" placeholder="Restaurant Name">
	</div>
		
		<!-- Input location -->
	<div class="form-group" style="display:inline-block">
		<input type="text" name="location" style="display:inline-block" class="form-control" id="location-id" placeholder="Location">
	</div>
		
		<!-- Restaurant/Food category -->
		<div style="display:inline-block">
			<select name="category" class="form-control">
				<option value="none">Select Category</option>
				@foreach($restaurant_categories as $category)
				<option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
				@endforeach
			</select>	
		</div>
		
		<!-- search button -->
		
		
	<div style="display:inline-block">
		<button type="submit" class="btn-default btn-lg">Search</button>
	</div>
	
	</form>
	@if(count($featured_restaurants) > 0)
	<div class="container" id="featured-restaurants"  style="margin-left: 20%">	
		<h1>Featured Restaurants</h1>
        <div class="row">
            <div class="box">
                <div class="col-lg-8 text-center">
                    <div id="carousel-example-generic" class="carousel slide" data-interval="3000" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        	@for($i = 1; $i < count($featured_restaurants); $i++)
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                        	@endfor
                        <!--
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>-->
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                        	@foreach($featured_restaurants as $index => $restaurant)
                        	@if($index == 0)
                        	<div class="item active">
                        	@else
                        	<div class="item">
                        	@endif
                                <img class="img-responsive img-full" src="{{ asset('img/'.$restaurant->img_name) }}" alt="">
                                <div class="carousel-caption">
												<h3>{{ $restaurant->name }}</h3>
									
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
	@endif

	<!--Recent reviews and top places-->
	
	<div class="container">

    <!--Row with two equal columns-->

	    <div class="row">

	        <div class="col-sm-6">
	        
	        <!--Column right-->
		        <div class="Most Popular Places">
		        	<h2>Most Popular Places</h2>
		        	<table>
		        		<thead>
		        			<tr>
		        				<th style="width: 50%"></th>
		        				<th style="width: 50%"></th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<!--<tr><h4 style="color: blue">Comic Cafe</h4></tr> -->
		        			<tr>
		        				
			        			<td  style="align: left valign:center">
			        				<br /> <h4 style="color: #6E0569">Comic Cafe</h4>
			        				<a href="Comic Cafe"><img src="{{ asset('img/Comic-Cafe.jpg') }}" class="img-responsive"/></a>
			        				
			        			</td>
			        		</tr>

			        		<tr> </tr>

			        		<!-- <tr><h4 style="color: blue">Pit Grill</h4></tr> -->

			        		<tr>
			        			<td>
			        				<br /> <h4 style="color: #6E0569">Pit Grill</h4>
			        				<a href="Pit Grill"><img src="{{ asset('img/pitGrill.jpg') }}" class="img-responsive" /></a>
			        			</td>
			        			
			        		</tr>
		        		</tbody>
		        	</table>
		        </div>
	        
	        </div>

	        <div class="col-sm-6">
	        
	        	<!--Recent reviews-->
				<div class="latest-reviews">
					<h2>Recent Reviews</h2>
					<ul class="list-group">
					@foreach($recent_reviews as $review)
						<li class="list-group-item list-group-item-info">
							{{ $review['user_name'] }} reviewed {{ $review['restaurant_name'] }} with	{{ $review['review_text'] }}					
						</li>
					@endforeach					
					</ul>
					
				</div>        
	        
	        </div>

	    </div>

    </div>

	
    

@endsection

@section('extrascripts')
<script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#example1').datepicker({
                format: "dd/mm/yyyy"
            });  
        
        });
    </script>
@endsection
