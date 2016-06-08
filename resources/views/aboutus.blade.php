@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<div class="jumbotron" style="background-color:#ffffff">
    <div class="container">
		
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h1 class="intro-text text-center" style="color:#8585e0;">About Online Restaurant Reservation System  </h1>
                    <hr>
                </div>
               
            </div>
        </div>

        <div class="row">
            <div class="box">
            	<div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Project
                        <strong>Supervisor</strong>
                    </h2>
                    <hr>
                </div>

            	<div class="col-sm-4 text-center" style="margin-left: 380px">
		            <img class="img-circle" src="{{ asset('img/'.'sir.jpg') }}" alt="Nazmus Saquib" height="150">
		            <h3>‎Nazmus Saquib</h3>
		            <h4>Lecturer, Dept. of CSE, BUET</h4>
        		</div>

                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Our
                        <strong>Team</strong>
                    </h2>
                    <hr>
                </div>

                <table style="margin-left: 210px">
                	<col width="600px">
                	<col width="600px">
                	<col width="600px">

                	<thead>
                		<th></th>
                		<th></th>
                		<th></th>
                	</thead>

                	<tbody>
                		<tr>
                			<td>
                				<img class="img-circle" src="{{ asset('img/'.'saqib.jpg') }}" alt="" height="130">
                    			<h3>Shadman Saqib Eusuf
		                        	<small>1205003</small>
		                    	</h3>
                			</td>

                			<td>
                				<img class="img-circle" src="{{ asset('img/'.'moosa.jpg') }}" alt="" height="130">
                    			<h3>Ibraheem Moosa
		                        	<small>1205005</small>
		                    	</h3>
                			</td>

                			<td>
                				<img class="img-circle" src="{{ asset('img/'.'ashik.jpg') }}" alt="" height="130">
                    			<h3>Kazi Ashik Islam
		                        	<small>1205007</small>
		                    	</h3>
                			</td>
                		</tr>
                	</tbody>
                </table>

                <div class="clearfix"></div>
            </div>
        </div>
        </div>
    </div>

@endsection
