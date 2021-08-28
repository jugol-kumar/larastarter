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
                @can('app.users.create')
                    <a href="{{route('app.users.create')}}" class="btn-shadow mr-3 btn btn-primary">
                        <i class="fa fa-plus-circle"></i> Create User
                    </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#Id</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Joined At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="text-center text-muted">#{{ $key+1 }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" class="rounded-circle"
                                                        src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar') : config('app.placeholder').'160.png'}}" alt="User">
                                                </div>

                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $user->name }}</div>
                                                <div class="widget-subheading opacity-7">
                                                    @if($user->role)
                                                        <span class="badge badge-info"> {{ $user->role->name }}</span>
                                                    @else
                                                        <span class="badge badge-danger"> No Role Found :( </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if($user->status == 1)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">In Active</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $user->created_at->diffForHumans() }}
                                </td>

                                <td class="text-center">
                                    @can('app.users.create')
                                        <a  class="btn btn-warning" href="{{ route('app.users.show', $user->id) }}">
                                            <i class="fas fa-eye"></i>  <span>Show</span>
                                        </a>
                                    @endcan

                                    @can('app.users.edit')
                                        <a  class="btn btn-info" href="{{ route('app.users.edit', $user->id) }}">
                                            <i class="fas fa-edit"></i>  <span>Edit</span>
                                        </a>
                                    @endcan

                                    @can('app.users.destroy')
                                        <button  class="btn btn-danger" type="button"
                                            onclick="deleteData({{ $user->id }})"
                                        >
                                            <i class="fas fa-trash-alt"></i>  <span>Delete</span>
                                        </button>

                                        <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('app.users.destroy', $user->id) }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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
