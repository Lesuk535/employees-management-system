@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-body bg-white">
                <a href="{{route('create-employee-form')}}" class="btn btn-success profile-button text-white mb-lg-4 ml-1">Create Employee</a>

                <table class="table table-responsive-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($managers as $manager)
                        <tr>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->email }}</td>
                            <td>{{ $manager->phone }}</td>
                            <td>{{ $manager->role }}</td>
                            <td>{{ $manager->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
