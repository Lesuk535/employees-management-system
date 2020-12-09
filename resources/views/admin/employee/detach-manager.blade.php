@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('edit-employee-form', $id)}}" class="btn btn-success text-white mb-lg-4 ml-1">Edit Employee</a>
                <a href="{{route('edit-employee-address-form', $id)}}" class="btn btn-primary text-white mb-lg-4 ml-1">Edit Address</a>
                <div class="btn-group mb-lg-4 ml-1" role="group">
                    <button class="btn btn-secondary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Managers</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                        <a class="dropdown-item" href="{{ route('attach-manager-form', $id) }}">Attach</a>
                        <a class="dropdown-item" href="{{ route('detach-manager-form', $id) }}">Detach</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Detach Manager</div>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('detach-manager', $id) }}">
                            @csrf
                            <div class="form-check d-flex justify-content-center flex-wrap" style="overflow: auto">
                                @foreach ($managers as $manager)
                                    <div class="styled-input-single" style="width: max-content;">
                                        <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                                            <label class="form-check-label">
                                                <input name="managers[]" value="{{$manager->id}}" class="form-check-input @error('managers') is-invalid @enderror" type="checkbox"> {{$manager->name}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <div class="text-center"><button class="btn btn-primary profile-button mt-4" type="submit">Save Changes</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
