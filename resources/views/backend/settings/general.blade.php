@extends('layouts.backend.app')

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>General Settings</div>
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


                    <form method="post" action="{{ route('app.settings.general.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_title">Name</label>
                                    <input id="site_title" type="text" class="form-control @error('site_title') is-invalid @enderror"
                                           name="site_title" value="{{ setting('site_title') ?? old('site_title') }}">
                                    @error('site_title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Site Description</label>
                                    <textarea id="site_description" type="text" class="form-control @error('site_description') is-invalid @enderror"
                                              name="site_description">{{ setting('site_description') ?? old('site_description') }} </textarea>
                                    @error('site_description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="description">Site Address</label>
                                    <textarea id="site_address" type="text" class="form-control @error('site_address') is-invalid @enderror"
                                              name="site_address">{{ setting('site_address') ?? old('site_address') }} </textarea>
                                    @error('site_address')
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
