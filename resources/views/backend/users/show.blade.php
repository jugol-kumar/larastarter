@extends('layouts.backend.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Users</div>
            </div>

            <div class="page-title-actions">
                <a href="{{route('app.users.edit', $user->id )}}" class="btn-shadow mr-3 btn btn-primary">
                    <i class="fa fa-edit"></i> edit
                </a>

                <a href="{{route('app.users.index')}}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fa fa-arrow-circle-left"></i> Back To Lest
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <img src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar') : config('app.placeholder').'160.png' }}" alt="" class="img-fluid img-thumbnail">
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <th  scope="row"> Name </th>
                            <td> {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th  scope="row"> Email </th>
                            <td> {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th  scope="row"> Role </th>
                            <td>
                                @if($user->role)
                                    <span class="badge badge-info"> {{ $user->role->name }}</span>
                                @else
                                    <span class="badge badge-danger"> No Role Found :( </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th  scope="row"> Status </th>
                            <td>
                                @if($user->status == 1)
                                    <span class="badge badge-info">Active</span>
                                @else
                                    <span class="badge badge-danger">In Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th  scope="row"> Joined At  </th>
                            <td> {{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th  scope="row"> Last Modefy At  </th>
                            <td> {{ $user->updated_at->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endpush
