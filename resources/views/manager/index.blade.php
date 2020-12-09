@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-body bg-white">
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Region</th>
                        <th>Street</th>
                        <th>Contract</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->country }}</td>
                            <td>{{ $employee->city }}</td>
                            <td>{{ $employee->region }}</td>
                            <td>{{ $employee->street }}</td>
                            <td>
                                <form method="POST" action="{{ route('show-contract') }}">
                                    @csrf
                                    <input type="hidden" name="contract-file" value="{{ $employee->getContractPath() }}" />
                                    <button type="submit" class="btn btn-link p-0 w-100">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
