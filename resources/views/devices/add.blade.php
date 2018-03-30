@extends('layouts.app')

@section('content')
    <h1>Add Device</h1>       
    {!! Form::open(['action' => 'DevicesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('device_id', 'Device ID')}}
            {{Form::text('device_id', '', ['class' => 'form-control', 'placeholder' => 'Device-ID'])}}
        </div>
        <div class="form-group">
                {{Form::label('imei', 'IMEI')}}
                {{Form::text('imei', '', ['class' => 'form-control', 'placeholder' => 'IMEI'])}}
        </div>
        <div class="form-group">
            {{Form::label('user', 'Assign to user')}}
            {{Form::text('user', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        {{Form::submit('Submit', ['class'=> 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection