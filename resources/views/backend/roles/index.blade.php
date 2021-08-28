@extends('layouts.backend.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Roles</div>
            </div>

            <div class="page-title-actions">
                <a href="{{route('app.roles.create')}}" class="btn-shadow mr-3 btn btn-primary">
                    <i class="fa fa-plus-circle"></i> Create Role
                </a>
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
                            <th class="text-center">Name</th>
                            <th class="text-center">Permissions</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Updated At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                <td class="text-center text-muted">#{{ $key+1 }}</td>
                                <td class="text-center">{{ $role->name }}</td>
                                @if($role->permissions->count() > 0)
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $role->permissions->count() }}</span>
                                </td>
                                @else
                                <td class="text-center">
                                    <span class="badge badge-danger">Permission Not Found :(</span>
                                </td>
                                @endif
                                <td class="text-center">
                                    {{ $role->created_at->diffForHumans() }}
                                </td>
                                <td class="text-center">
                                    {{ $role->updated_at->diffForHumans() }}
                                </td>
                                <td class="text-center">
                                    <a  class="btn btn-info" href="{{ route('app.roles.edit', $role->id) }}">
                                        <i class="fas fa-edit"></i>  <span>Edit</span>
                                    </a>
                                    @if( $role->deletable == true)
                                        <button  class="btn btn-danger" type="button"
                                            onclick="deleteData({{ $role->id }})"
                                        >
                                            <i class="fas fa-trash-alt"></i>  <span>Delete</span>
                                        </button>

                                        <form id="delete-form-{{ $role->id }}" method="POST" action="{{ route('app.roles.destroy', $role->id) }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
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
