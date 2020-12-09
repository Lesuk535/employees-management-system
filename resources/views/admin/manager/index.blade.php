@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-body bg-white">
                <a href="{{route('create-employee-form')}}" class="btn btn-success profile-button text-white mb-lg-4 ml-1">Create Employee</a>
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin-show-managers') }}">Managers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('show-employees') }}">Employees</a></li>
                </ul>
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Profile link</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($managers as $manager)
                            <tr>
                                <td>{{ $manager->name }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>{{ $manager->status }}</td>
                                <td><a href="{{ route('show-manager', $manager->id) }}">link</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
