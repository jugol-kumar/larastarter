@extends('layouts.backend.app')

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($menu) ? 'Edit ' : 'Create ' }}Menu</div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('app.menus.index')}}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fa fa-arrow-circle-left"></i> Back To Lest
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ isset($menu) ? route('app.menus.update', $menu->id) : route('app.menus.store') }}">
                @csrf
                @isset($menu)
                    @method('PUT')
                @endisset

                <div class="row">
                    <div class="col-md-8 m-auto">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Menu Info</h5>

                            <div class="form-group">
                                <label for="title">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $menu->name ?? old('name') }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" type="text" class="form-control @error('Description') is-invalid @enderror"
                                          name="description" required autofocus>{{ $menu->description ?? old('Description') }} </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @if(isset($menu))
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
