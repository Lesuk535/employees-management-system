@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Employee information</div>
                    <table class="table table-responsive-sm table-bordered m-0">
                        <tbody>
                        <tr>
                            <td><b>Name</b></td>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Phone</b></td>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
