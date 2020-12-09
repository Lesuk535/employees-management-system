@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-danger">Ow-w-w-w...This account is no longer active.</div>

                    <div class="card-body p-0">
                        <img src='{{asset('images/dwight_sad.gif')}}' class='w-100'/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
