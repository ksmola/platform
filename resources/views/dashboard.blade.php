@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p> 
                    <p>Administrator Privileges:  
                        @if($isadmin)
                            <i class="fas fa-check-circle green"></i>
                        ￼@else
                            <i class="fas fa-times-circle red"></i>
                        ￼@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
