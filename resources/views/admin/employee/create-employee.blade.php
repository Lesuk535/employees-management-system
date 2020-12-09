@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Employee</div>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('create-employee') }} ">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country">

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">Сity</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="region" class="col-md-4 col-form-label text-md-right">Region</label>

                                <div class="col-md-6">
                                    <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region">

                                    @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street" class="col-md-4 col-form-label text-md-right">Street</label>

                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street">

                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="managers" class="col-md-4 col-form-label text-md-right">Managers</label>
                                <div class="col-md-6" >
                                    <div class="dropdown d-inline-block w-100" style="display: flex;">
                                        <div class="btn btn-block btn-outline-info add-category-btn" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flex; justify-content: flex-end" >

                                            <div class="dropdown-toggle" style="justify-self: right;">
                                            </div>
                                        </div>

                                        <div class="dropdown-menu no-close dropdown-menu-category w-100" aria-labelledby="dropdownMenuButton">
                                            <div class="form-check" style="overflow: auto">

                                                <div class="styled-input-single" style="width: max-content;">
                                                    @foreach ($managers as $manager)
                                                        <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                                                            <label class="form-check-label">
                                                                <input name="managers[]" value="{{$manager->id}}" class="form-check-input @error('managers') is-invalid @enderror" type="checkbox"> {{$manager->name}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    @error('managers')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contractDate" class="col-md-4 col-form-label text-md-right">Contract Date</label>

                                <div class="col-md-6">
                                    <input id="contractDate" type="date" class="form-control @error('contract_date') is-invalid @enderror" name="contract_date">

                                    @error('contract_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contractExpiration" class="col-md-4 col-form-label text-md-right">Contract Expiration</label>

                                <div class="col-md-6">
                                    <input id="contractExpiration" type="date" class="form-control @error('contract_expiration') is-invalid @enderror" name="contract_expiration">

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
                                        Create
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
