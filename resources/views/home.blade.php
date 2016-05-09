@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div>
        
        <!-- Number of persons -->
        
        <div class="person-date-select"  style="padding-left: 150px; display: inline-block;">
            <div style="display:inline-block">
                <select class="form-control">
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
                        <input  type="text" placeholder="click to show datepicker"  id="example1">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- time selection -->
        <div style="display:inline-block;">
            <select class="form-control">
                <option value="1">07:00PM</option>
                <option value="2">07:30PM</option>
                <option value="3">08:00PM</option>
                <option value="4">08:30PM</option>
                <option value="5">09:00PM</option>
            </select>   
        </div>
        
        <!-- Input restaurant name -->
        <div class="form-group" style="display:inline-block">
            <input type="text" style="display:inline-block" class="form-control" id="usr" placeholder="Restaurant Name">
        </div>
        
        <!-- Input location -->
        <div class="form-group" style="display:inline-block">
            <input type="text" style="display:inline-block" class="form-control" id="usr" placeholder="Location">
        </div>
        
        <!-- Restaurant/Food category -->
        <div style="display:inline-block">
            <select class="form-control">
                <option value="1">Thai</option>
                <option value="2">Chinese</option>
                <option value="3">Bangali</option>
                <option value="4">Italian</option>
                <option value="5">Seafood</option>
            </select>   
        </div>
        
        <!-- search button -->
        <div style="display:inline-block">
            <button type="button" class="btn-default btn-lg">Search</button>
        </div>
        
    </div>


    <!-- Featured Restaurant with slider -->

    <div class="container" id="featured-restaurants"  style="margin-left: 20%"> 
        <h1>Featured Restaurants</h1>
        <div class="row">
            <div class="box">
                <div class="col-lg-8 text-center">
                    <div id="carousel-example-generic" class="carousel slide" data-interval="3000" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <!--<li data-target="#carousel-example-generic" data-slide-to="2"></li>-->
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="img/Restaurant-Atrium-003.jpg" alt="">
                                <div class="carousel-caption">
                                    <h3>The Atrium Restaurant</h3>
                                    
                                </div>
                            </div>

                            <div class="item">
                                <img class="img-responsive img-full" src="img/Gloria_Jeans_Coffee.jpg" alt="">
                                <div class="carousel-caption">
                                    <h3>Gloria Jeans Coffee</h3>
                                    
                                </div>
                            </div>

                        </div>

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
                                    <a href="Comic Cafe"><img src="img/Comic-Cafe.jpg" class="img-responsive"/></a>
                                    
                                </td>
                            </tr>

                            <tr> </tr>

                            <!-- <tr><h4 style="color: blue">Pit Grill</h4></tr> -->

                            <tr>
                                <td>
                                    <br /> <h4 style="color: #6E0569">Pit Grill</h4>
                                    <a href="Pit Grill"><img src="img/pitGrill.jpg" class="img-responsive" /></a>
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
                        <li class="list-group-item list-group-item-info"><a href="#">Anonymous</a> reviwed <a href="#">KFC</a> by 5 star </li>

                        <li class="list-group-item list-group-item-info">"The Coffee was great at a reasonable price." - <a href="#">Jane Doe</a> at <a href="#">Gloria Jeans</a> </li>
                        
                        <li class="list-group-item list-group-item-info"> "Great environment here at KFC" - <a href="#">Jon Doe</a> </li>
                    </ul>
                    
                </div>        
            
            </div>

        </div>

    </div>
@endsection