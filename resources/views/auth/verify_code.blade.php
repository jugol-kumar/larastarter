@extends('layouts.frontend.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="alert alert-danger"><strong>Alert ! </strong>{{ Session::get('message') }}</p>
                        @endif
                        <form class="d-inline" method="POST" action="{{ route('verifyUser') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" name="code" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info">Check</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="">Resend Code</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
