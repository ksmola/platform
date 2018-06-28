@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <a href="/devices" ><i class="green fas fa-chevron-circle-left"></i> Back</a>
    <a href="/devices/{{$device->id}}/edit" class="float-right"><i class="fas fa-edit green"></i> Edit</a>
￼
<h2 class="text-center">{{$device->name}}</h2>


    <table class="table table-striped w-50">
        <tbody>
            <tr>
                <th scope="row">id</th>
                <td scope="row">{{$device->id}}</td>
            </tr>
            <tr>
                <th scope="row">Device ID</th>
                <td scope="row">{{$device->id}}</td>
            </tr>
            <tr>
                <th scope="row">User ID</th>
                <td scope="row">{{$device->user_id}}</td>
            </tr>
            <tr>
                <th scope="row">IMEI</th>
                <td scope="row">{{$device->imei}}</td>
            </tr>
            <tr>
                <th scope="row">Last Position</th>
                <td scope="row">{{$position->lat}}, {{$position->lng}}</td>
            </tr>
            <tr>
                <th scope="row">Token</th>
                <td scope="row">{{$device->token}}</td>
            </tr>
            <tr>
                <th scope="row">New Token</th>
                <td scope="row">{{$device->new_token}}</td>
            </tr>
            <tr>
                <th scope="row">Last Request</th>
                <td scope="row">{{$device->last_request_received}}</td>
            </tr>
            <tr>
                <th scope="row">Last Token</th>
                <td scope="row">{{$device->last_token_received}}</td>
            </tr>
            <tr>
                <th scope="row">Token created</th>
                <td scope="row">{{$device->token_created}}</td>
            </tr>
            <tr>
                <th scope="row">Token updated</th>
                <td scope="row">{{$device->token_updated}}</td>
            </tr>
            <tr>
                <th scope="row">Last valid Response</th>
                <td scope="row">{{$device->responded}}</td>
            </tr>
            <tr>
                <th scope="row">Last Request</th>
                <td scope="row">{{$device->last_request}}</td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td scope="row">{{$device->status}}</td>
            </tr>
            <tr>
                <th scope="row">Alarm</th>
                <td scope="row">{{$device->alarm}}</td>
            </tr> 
        </tbody>
    </table>
</div>
@endsection