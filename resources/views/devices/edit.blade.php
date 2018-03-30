@extends('layouts.app')

@section('content')
    <h1>Edit Device</h1>       
    {!! Form::open(['action' => ['DevicesController@update', $device->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('device_id', 'Device ID')}}
            {{Form::text('device_id', $device->device_id, ['class' => 'form-control', 'placeholder' => 'Device-ID'])}}
        </div>
        <div class="form-group">
                {{Form::label('imei', 'IMEI')}}
                {{Form::text('imei', $device->imei, ['class' => 'form-control', 'placeholder' => 'IMEI'])}}
        </div>
        <div class="form-group">
            @if(auth()->user()->is_admin) 
                {{Form::label('user', 'Assign to user')}}
                {{Form::text('user', $device->user_id, ['class' => 'form-control', 'placeholder' => 'user_id'])}}
            @endif
        </div>
        {{Form::hidden('_method', 'PUT')}}
        <div class="row">
            <div class="col-sm">
                {{Form::submit('Submit', ['class'=> 'btn btn-dark mt-1 mb-1'])}}
            </div>
    {!! Form::close() !!}
    {!! Form::open(['action' => ['DevicesController@destroy', $device->id], 'method' => 'POST', 'class' => 'float-right'])!!}
        <div class="col-sm">
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger mt-1 mb-1'])}}
        </div>
        </div>
    {!! Form::close() !!}
@endsection