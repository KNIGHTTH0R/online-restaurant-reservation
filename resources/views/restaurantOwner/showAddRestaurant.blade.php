@extends('layouts.app')

@section('title', 'Add Restaurant')

@section('content')

<div class="container" id="add-restaurant-form">
    <div class="row">
        <div class="col-md-12">
            <form style="text-align:center" action="{{ url('storeRestaurant') }}" method="POST">
                {{ csrf_field() }}
                
                <label for="name">Restaurant Name: </label>
                <input type="text" name="name" id="name"><br>
                <label for="location">Location: </label>
                <input type="text" name="location" id="location"><br>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email"><br>
                <label for="contactno">Contact No.: </label>
                <input type="text"  name="contactno" id="contactno"><br>
                <label for="website">Website: </label>
                <input type="url" name="website" id="website"><br>
                <label for="description">Describe your restaurant: </label><br>
                <textarea name="description" id="description" cols=50 rows=10>
                </textarea><br>
                <input type="checkbox" name="parking" id="parking" value="parking-available"><br>
                <input type="submit">
            </form>
        </div>
    </div>
</div>


@endsection
