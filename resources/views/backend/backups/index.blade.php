@extends('layouts.backend.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-cloud icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Backups</div>
            </div>

            <div class="page-title-actions">

                <button type="button" class="btn-shadow mr-3 btn btn-danger" onclick="event.preventDefault();
                        document.getElementById('clean-backup-form').submit();">
                    <i class="fa fa-trash"></i> Clean Old Backups
                </button>
                <form id="clean-backup-form" method="POST" action="{{ route('app.backups.clean') }}" style="display:none">
                    @csrf
                    @method("DELETE")
                </form>


                <button type="button" class="btn-shadow mr-3 btn btn-primary" onclick="event.preventDefault();
                        document.getElementById('new-backup-form').submit();">
                    <i class="fa fa-plus-circle"></i> Create Backups
                </button>
                <form id="new-backup-form" action="{{ route('app.backups.store') }}" method="POST" style="display:none">
                    @csrf
                </form>
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
                            <th class="text-center">File Name</th>
                            <th class="text-center">File Size </th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($backups as $key => $backup)
                            <tr>
                                <td class="text-center text-muted">#{{ $key+1 }}</td>
                                <td class="text-center">
                                    <code>{{ $backup['file_name'] }}</code>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-primary">{{ $backup['file_size'] }}</span>
                                </td>
                                <td class="text-center">
                                    {{ $backup['created_at']}}
                                </td>
                                <td class="text-center">
                                    <a  class="btn btn-info" href="{{ route('app.backups.download', $backup['file_name']) }}">
                                        <i class="fas fa-edit"></i>  <span>Download</span>
                                    </a>

                                    <button  class="btn btn-danger" type="button"
                                        onclick="deleteData({{ $key }})"
                                    >
                                        <i class="fas fa-trash-alt"></i>  <span>Delete</span>
                                    </button>

                                    <form id="delete-form-{{ $key }}" method="POST" action="{{ route('app.backups.destroy', $backup['file_name']) }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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
