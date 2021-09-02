@extends('layouts.backend.app')
@push('css')
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
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Appearance Settings</div>
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


                    <form method="post" action="{{ route('app.settings.appearance.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="site_logo">Logo (Only Image Allowed)</label>

                                        <input type="file" class="dropify @error('site_logo') is-invalid @enderror"
                                               id="site_logo" name="site_logo"
                                               data-default-file="{{ setting('site_logo') != null ? Storage::url(setting('site_logo')) : '' }}">

                                        @error('site_logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="site_favicon">Favicon (Only Image Allowed & Size 33 X 33 )</label>

                                        <input type="file" class="dropify @error('site_favicon') is-invalid @enderror"
                                               id="site_favicon" name="site_favicon"
                                               data-default-file="{{ setting('site_favicon') != null ? Storage::url(setting('site_favicon')) : '' }}">

                                        @error('site_favicon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                <button type="submit" class="btn btn-primary">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush
