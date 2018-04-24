@extends('layouts.app')

@section('content')

@guest
{{-- guest view --}}
@else

    <h1>moki tracking</h1>
    <p>recent positions:</p>
    
@endguest
@endsection
