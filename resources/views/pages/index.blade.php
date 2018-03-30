@extends('layouts.app')

@section('content')
@guest
<div class="jumbotron text-center">
<h1>please:</h1>
<a class="btn btn-primary" href="/register">Register</a>    
<a class="btn btn-primary" href="/login">Sign In</a>
</div>
@else

hi
        {{--  <h1>{{$title}}</h1>  --}}
<br>
@endguest 
@endsection