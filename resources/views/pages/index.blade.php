@extends('layouts.app')

@section('content')
@guest
<div class="jumbotron text-center">
<h2>Please choose:</h2>
<a class="btn btn-primary" href="/register">Register</a>    
<a class="btn btn-primary" href="/login">Sign In</a>
</div>
@else

<h3>Hello, {{$user->name}}</h3>

<br>
@endguest 
@endsection