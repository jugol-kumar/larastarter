@extends('layouts.backend.app')

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Mail Settings</div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('app.dashboard')}}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fa fa-arrow-circle-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row mb-5">

                <div class="col-md-3">
                    @include('backend.settings.sidebar')
                </div>


                <div class="col-md-9">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">How to use?</h5>
                            <p>You can get the value of match settings anywhere on your side by <code>settings('key')</code></p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('app.settings.mail.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="col">
                                        <label for="mail_mailer">Mailer</label>
                                        <input id="mail_mailer" type="text" class="form-control @error('mail_mailer') is-invalid @enderror"
                                               name="mail_mailer" value="{{ setting('mail_mailer') ?? old('mail_mailer') }}">
                                        @error('mail_mailer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="mail_encryption">Encryption</label>
                                        <input id="mail_encryption" type="text" class="form-control @error('mail_encryption') is-invalid @enderror"
                                               name="mail_encryption" value="{{ setting('mail_encryption') ?? old('mail_encryption') }}">
                                        @error('mail_encryption')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="mail_host">Host</label>
                                        <input id="mail_host" type="text" class="form-control @error('mail_host') is-invalid @enderror"
                                               name="mail_host" value="{{ setting('mail_host') ?? old('mail_host') }}">
                                        @error('mail_host')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="mail_port">Port</label>
                                        <input id="mail_port" type="text" class="form-control @error('mail_port') is-invalid @enderror"
                                               name="mail_port" value="{{ setting('mail_port') ?? old('mail_port') }}">
                                        @error('mail_port')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="mail_username">Username</label>
                                        <input id="mail_username" type="text" class="form-control @error('mail_username') is-invalid @enderror"
                                               name="mail_username" value="{{ setting('mail_username') ?? old('mail_username') }}">
                                        @error('mail_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="mail_password">Password</label>
                                        <input id="mail_password" type="text" class="form-control @error('mail_password') is-invalid @enderror"
                                               name="mail_password" value="{{ setting('mail_password') ?? old('mail_password') }}">
                                        @error('mail_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="mail_from_address">From Address</label>
                                        <input id="mail_from_address" type="text" class="form-control @error('mail_from_address') is-invalid @enderror"
                                               name="mail_from_address" value="{{ setting('mail_from_address') ?? old('mail_from_address') }}">
                                        @error('mail_from_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label for="mail_from_name">From Name</label>
                                        <input id="mail_from_name" type="text" class="form-control @error('mail_from_name') is-invalid @enderror"
                                               name="mail_from_name" value="{{ setting('mail_from_name') ?? old('mail_from_name') }}">
                                        @error('mail_from_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="fa fa-arrow-circle-up"></i>
                                    Update
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.tiny.cloud/1/4djk3cud91pzgow03ex6gqsegn6aat4f5v1ux5c1at99hkgo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        tinymce.init({
            selector: '#body',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
@endpush
