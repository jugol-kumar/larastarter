@extends('layouts.backend.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style>
        .dropify-wrapper .dropify-message p{
            font-size: initial;
        }
    </style>
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($users) ? 'Edit ' : 'Create' }}User</div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('app.users.index')}}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fa fa-arrow-circle-left"></i> Back To Lest
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ isset($user) ? route('app.users.update', $user->id) : route('app.users.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Info</h5>

                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $user->name ?? old('name') }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="email">User Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ $user->name ?? old('email') }}" required autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" {{ !isset($user) ? 'required' : '' }} autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="conform_password">Conform Password</label>
                                <input id="conform_password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password_confirmation" {{ !isset($user) ? 'required' : '' }}>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Select Roles And Status</h5>
                            <div class="form-group">
                                <label for="select-role">Select Role</label>
                                <select id="select-role" name="role" class="js-example-basic-single form-control @error('role') is-invalid @enderror" required >
                                    @foreach($roles as $key=> $role)
                                        <option value="{{ $role->id }}" @isset( $user) {{ $user->role_id == $role->id ? 'selected' : ''}} @endisset }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="dropify @error('role') is-invalid @enderror" id="avatar" name="avatar" data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : '' }}" {{ !isset($user) ? 'required' : '' }}>
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>

                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if(isset($user))
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-arrow-circle-up"></i>
                                    Update
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    create
                                </button>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
