@extends('backend.layouts.index')


@push('styles')
    <!--plugins-->
    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!--plugins-->

    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/table-datatable.js"></script>
@endpush


@section('content')
    <div class="d-flex justify-content-between mb-2" style="align-items: baseline">
        {{-- <div class="col-"> --}}
        <h6 class="mb-0 text-uppercase">Tag List</h6>
        {{-- </div> --}}
        {{-- <div class="left"> --}}
        <a href="{{ route('backend.tag-create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
           + Add Tag
        </a>
        {{-- </div> --}}
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>

                            <th>Slug</th>
                            @if (hasPermission('backend.tag-update_status'))
                                <th>Status</th>
                            @endif
                            @if (hasPermission('backend.tag-edit') || hasPermission('backend.tag-delete'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->title }}</td>

                                <td>
                                    {{ $tag->slug }}
                                </td>

                                @if (hasPermission('backend.tag-update_status'))
                                    <td>
                                        <a href="{{ route('backend.tag-update_status', $tag->id) }}"
                                            class="btn btn-sm btn-{{ $tag->status == 1 ? 'success' : 'danger' }}">
                                            {{ $tag->status == 1 ? 'Active' : 'InActive' }}
                                        </a>

                                    </td>
                                @endif

                                @if (hasPermission('backend.tag-edit') || hasPermission('backend.tag-delete'))
                                    <td>
                                        <div class="btn-group">
                                            @if (hasPermission('backend.tag-edit'))
                                                <a href="{{ route('backend.tag-edit', $tag->id) }}"
                                                    class="btn btn-warning btn-sm mx-2">Edit</a>
                                            @endif
                                            @if (hasPermission('backend.tag-delete'))
                                                <a href="{{ route('backend.tag-delete', $tag->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>

                            <th>Slug</th>
                            @if (hasPermission('backend.tag-update_status'))
                                <th>Status</th>
                            @endif
                            @if (hasPermission('backend.tag-edit') || hasPermission('backend.tag-delete'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
