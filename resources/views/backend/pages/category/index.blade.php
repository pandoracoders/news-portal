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
        <h6 class="mb-0 text-uppercase">Category List</h6>
        {{-- </div> --}}
        @if (hasPermission('backend.category-create'))
            <a href="{{ route('backend.category-create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i>
               + Add Category
            </a>
        @endif

    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Order</th>
                            @if (hasPermission('backend.category-update_status'))
                                <th>Status</th>
                            @endif
                            @if (hasPermission('backend.category-edit') || hasPermission('backend.category-delete'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td>
                                    {{ $category->slug }}
                                </td>
                                <td>
                                    {{ $category->order }}
                                </td>
                                @if (hasPermission('backend.category-update_status'))
                                    <td>
                                        <a href="{{ route('backend.category-update_status', $category->id) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-{{ $category->status == 1 ? 'success' : 'danger' }}">
                                            {{ $category->status == 1 ? 'Active' : 'InActive' }}
                                        </a>
                                    </td>
                                @endif

                                @if (hasPermission('backend.category-edit') || hasPermission('backend.category-delete'))
                                    <td>
                                        <div class="btn-group">
                                            @if (hasPermission('backend.category-edit'))
                                                <a href="{{ route('backend.category-edit', $category->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @endif
                                            @if (hasPermission('backend.category-delete'))
                                                <a href="{{ route('backend.category-delete', $category->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                            @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                           
                            <th>Slug</th>
                            <th>Order</th>
                            @if (hasPermission('backend.category-edit'))
                                <th>Status</th>
                            @endif
                            @if (hasPermission('backend.category-edit') || hasPermission('backend.category-delete'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
