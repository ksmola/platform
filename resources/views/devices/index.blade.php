@extends('layouts.app')

@section('content')
    @guest
    <?php
    header('Location: /'); 
    exit();
    ?>
    @else
    <div class="container">
    <br>
    <h2>Devices</h2>              
    <p>Overview of all your mokis</p>
    <a class="float-right" href="/devices/create"><i class="green fas fa-plus-circle"></i> Add moki</a>
    <br>

    @if(count($devices) > 0)
        @foreach($devices as $device)
        <a href="/devices/{{$device->id}}">
            <div class="list-group">
                <li class="list-group-item mt-1 mb-1">
                    <h4>{{$device->name}}</h4>
                    <small>IMEI: {{$device->link_id}}</small>
                    <?php
                    if ($device->alarm) {
                        echo '<div class="blink-red font-weight-bold float-right">ALARM</div>';
                    }
                    ?>
                </li>
            </div></a>
        @endforeach
        {{$devices->links()}}
    @else
        <h3>Error: no mokis found!</h3>
    @endif
        </div>
    @endguest

@endsection