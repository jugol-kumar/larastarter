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
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($page) ? 'Edit ' : 'Create' }}Page</div>
            </div>
            <div class="page-title-actions">
                <a href="{{route('app.pages.index')}}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fa fa-arrow-circle-left"></i> Back To Lest
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ isset($page) ? route('app.pages.update', $page->id) : route('app.pages.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($page)
                    @method('PUT')
                @endisset

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Basic Info</h5>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ $page->title ?? old('title') }}" required autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea id="excerpt" type="text" class="form-control @error('excerpt') is-invalid @enderror"
                                          name="excerpt" required autofocus>{{ $page->excerpt ?? old('excerpt') }} </textarea>
                                @error('excerpt')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror"
                                          name="body" required autofocus>{{ $page->excerpt ?? old('body') }} </textarea>
                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Features Image And Status </h5>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="dropify @error('role') is-invalid @enderror" id="image" name="image" data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : '' }}" {{ !isset($page) ? 'required' : '' }}>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($page) {{ $page->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>

                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if(isset($page))
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

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Search SEO And Metatag </h5>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea id="meta_description" type="text" class="form-control @error('meta_description') is-invalid @enderror"
                                              name="meta_description" required autofocus>{{ $page->meta_description ?? old('meta_description') }} </textarea>
                                    @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <textarea id="meta_keywords" type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                              name="meta_keywords" required autofocus>{{ $page->meta_keywords ?? old('meta_keywords') }} </textarea>
                                    @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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

{{--    <script>--}}
{{--        tinymce.init({--}}
{{--            selector: '#body',--}}
{{--            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',--}}
{{--            imagetools_cors_hosts: ['picsum.photos'],--}}
{{--            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',--}}
{{--            toolbar_sticky: true,--}}
{{--            image_advtab: true,--}}
{{--            content_css: '//www.tiny.cloud/css/codepen.min.css',--}}
{{--            importcss_append: true,--}}
{{--            height: 400,--}}
{{--            image_caption: true,--}}
{{--            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',--}}
{{--            noneditable_noneditable_class: "mceNonEditable",--}}
{{--            toolbar_mode: 'sliding',--}}
{{--            contextmenu: "link image imagetools table",--}}
{{--        });--}}
{{--    </script>--}}

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
