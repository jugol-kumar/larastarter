@extends('layouts.frontend.app');

@section('title', 'Home')

@push('css')
    <link href="{{asset('assets/frontend/css/homeCss/styles.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/css/homeCss/responsive.css')}}" rel="stylesheet">
@endpush


@section('content')
    <div class="container">
        <h1 class="display-4 align-content-center">Wellcome To Laravel Freash Project Laravel 8x</h1>

        <br><br>
        <hr>
        <a href="{{ route('sendsms') }}" class="btn btn-danger">Send Sms</a>

    </div>
@endsection

@push('js')
    <script src="{{asset('assets/frontend/js/swiper.js')}}"></script>
@endpush



