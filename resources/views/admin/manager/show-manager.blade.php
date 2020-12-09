@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-body bg-white d-flex">
                <table class="table table-responsive-sm table-bordered col-md-4 mr-5">
                    <tbody>
                        <tr><td class="text-center"><b>Profile Details</b></td></tr>
                        <tr><td><b>Name</b>: {{ $manager->name }}</td></tr>
                        <tr><td><b>Email</b>: {{ $manager->email }}</td></tr>
                        <tr><td><b>Role</b>: {{ $manager->role }}</td></tr>
                        <tr><td><b>Status</b>: {{ $manager->status }}</td></tr>
                        <tr><td><b>Created at</b>: {{ $manager->created_at }}</td></tr>
                        <tr><td><b>Updated at</b>: {{ $manager->updated_at }}</td></tr>
                    </tbody>
                </table>
                <table class="table table-responsive-sm table-bordered col-md-4">
                        <tbody>
                            <tr><td class="text-center"><b>Employees</b></td></tr>
                            @foreach($employees as $employee)
                                <tr><td>{{ $employee->name }} <a href="{{ route('edit-employee-form', $employee->id) }}">edit</a></td></tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
