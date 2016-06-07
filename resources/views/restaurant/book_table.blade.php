@extends('layouts.app')

@section('content')

BOOK TABLE
<p>
@foreach($available_tables as $available_table)
	{{ $available_table->capacity }}
	{{ $available_table->booking_fee }}
@endforeach
</p>
@endsection