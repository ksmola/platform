@extends('layouts.app')

@section('content')
    <h1>Devices</h1>              
    <p>Overview of all your mokis</p>
    @guest
    @else
    <a class="float-right" href="/devices/create"><i class="green fas fa-plus-circle"></i> Add moki</a>
    <br>
    @endguest

    @if(count($devices) > 0)
        @foreach($devices as $device)
        <a href="/devices/{{$device->id}}">
            <div class="list-group">
                <li class="list-group-item mt-1 mb-1">
                    <h4>{{$device->device_id}}</h4>
                    <small>IMEI: {{$device->imei}}</small>
                </li>
            </div></a>
        @endforeach
        {{$devices->links()}}
    @else
        <h3>Error: no mokis found!</h3>
    @endif
@endsection