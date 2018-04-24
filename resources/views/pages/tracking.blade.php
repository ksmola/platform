@extends('layouts.app')

@section('content')

@guest
{{-- guest view --}}
@else

    <h1>{{$title}}</h1>
    <p>recent positions:</p>
    @if(count($services) >0)
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
        </ul>
    @endif
@endguest
@endsection
