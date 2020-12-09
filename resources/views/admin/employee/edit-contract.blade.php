@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('edit-employee-form', $employee->id)}}" class="btn btn-success text-white mb-lg-4 ml-1">Edit Employee</a>
                <a href="{{route('edit-employee-address-form', $employee->id)}}" class="btn btn-primary text-white mb-lg-4 ml-1">Edit Address</a>
                <div class="btn-group mb-lg-4 ml-1" role="group">
                    <button class="btn btn-secondary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Managers</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                        <a class="dropdown-item" href="{{ route('attach-manager-form', $employee->id) }}">Attach</a>
                        <a class="dropdown-item" href="{{ route('detach-manager-form', $employee->id) }}">Detach</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Edit Contract</div>
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-success">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('edit-employee-contract', $employee->id) }} ">
                            @csrf
                            <div class="form-group row">
                                <label for="contractExpiration" class="col-md-4 col-form-label text-md-right">Contract Expiration</label>

                                <div class="col-md-6">
                                    <input value="{{ $employee->getContractDate() }}" id="contractExpiration" type="date" class="form-control @error('contract_expiration') is-invalid @enderror" name="contract_expiration">

                                    @error('contract_expiration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">Contract file</label>
                                <div class="col-md-6">
                                    <input id="file" type="file" class="@error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
