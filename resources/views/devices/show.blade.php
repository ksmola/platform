@extends('layouts.app')

@section('content')
    <a href="/devices" ><i class="green fas fa-chevron-circle-left"></i> Back</a>
    <a href="/devices/{{$device->id}}/edit" class="float-right"><i class="fas fa-edit green"></i> Edit</a>
￼
    <h2>{{$device->device_id}}</h2>

@endsection