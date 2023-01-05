@extends('backend.layouts.index')


@push('styles')
    <style>
        .category{
            border: 1px solid rgb(184, 183, 183);
            border-radius: 5px;
            padding: 7px 7px;
            margin-bottom: 10px;
            background: rgb(233, 233, 233);
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 500;
            color: rgb(41, 40, 40);

        }
        .sub-category{
            border: 1px solid rgb(207, 238, 140);
            border-radius: 5px;
            padding: 5px 5px;
            margin-bottom: 5px;
            margin-left: 45px;
            background: #c8efec;
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 500;
            color: rgb(41, 40, 40);
        }
    </style>
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
            @foreach ($categories as $category)
                @if ($category->parent_id == null)
                    <div class="category">
                        <span>{{ $category->title }}</span>
                        <span>
                            @if (hasPermission('backend.category-update_status'))
                                <a href="{{ route('backend.category-update_status', $category->id) }}"
                                    class="btn btn-sm btn-{{ $category->status == 1 ? 'success' : 'danger' }}">
                                    {{ $category->status == 1 ? 'Active' : 'InActive' }}
                                </a>
                            @endif
                            @if (hasPermission('backend.category-edit') || hasPermission('backend.category-delete'))
                                <div class="btn-group">
                                    @if (hasPermission('backend.category-edit'))
                                        <a href="{{ route('backend.category-edit', $category->id) }}"
                                            class="btn btn-warning btn-sm mx-2">Edit</a>
                                    @endif
                                    @if (hasPermission('backend.category-delete'))
                                        <a href="{{ route('backend.category-delete', $category->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    @endif
                                </div>
                            @endif
                        </span>

                    </div>
                @endif
                @foreach ($categories as  $cat)
                    @if ($category->id == $cat->parent_id)
                        <div class="sub-category">
                            <span>{{ $cat->title }}</span>
                            <span>
                                @if (hasPermission('backend.category-update_status'))
                                    <a href="{{ route('backend.category-update_status', $cat->id) }}"
                                        class="btn btn-sm btn-{{ $cat->status == 1 ? 'success' : 'danger' }}">
                                        {{ $cat->status == 1 ? 'Active' : 'InActive' }}
                                    </a>
                                @endif
                                @if (hasPermission('backend.category-edit') || hasPermission('backend.category-delete'))
                                    <div class="btn-group">
                                        @if (hasPermission('backend.category-edit'))
                                            <a href="{{ route('backend.category-edit', $cat->id) }}"
                                                class="btn btn-warning btn-sm mx-2">Edit</a>
                                        @endif
                                        @if (hasPermission('backend.category-delete'))
                                            <a href="{{ route('backend.category-delete', $cat->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        @endif
                                    </div>
                                @endif
                            </span>
                        </div>
                    @endif
                @endforeach
                    {{-- <tr>
                        <td>{{ $category->title }}</td>
                        <td>
                            {{ $category->slug }}
                        </td>
                        @if (hasPermission('backend.category-update_status'))
                            <td>
                                <a href="{{ route('backend.category-update_status', $category->id) }}"
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
                                            class="btn btn-warning btn-sm mx-2">Edit</a>
                                    @endif
                                    @if (hasPermission('backend.category-delete'))
                                        <a href="{{ route('backend.category-delete', $category->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    @endif
                            </td>
                        @endif
                        @foreach ($categories as  $cat)

                            @if ($category->id == $cat->parent_id)
                                <tr style="background: rgb(213, 213, 212); ">
                                    <td>
                                        {{ $cat->title }}
                                    </td>
                                    <td>
                                        {{ $cat->slug }}
                                    </td>

                                    @if (hasPermission('backend.category-update_status'))
                                        <td>
                                            <a href="{{ route('backend.category-update_status', $cat->id) }}"
                                                class="btn btn-sm btn-{{ $cat->status == 1 ? 'success' : 'danger' }}">
                                                {{ $cat->status == 1 ? 'Active' : 'InActive' }}
                                            </a>
                                        </td>
                                    @endif

                                    @if (hasPermission('backend.category-edit') || hasPermission('backend.category-delete'))
                                        <td>
                                            <div class="btn-group">
                                                @if (hasPermission('backend.category-edit'))
                                                    <a href="{{ route('backend.category-edit', $cat->id) }}"
                                                        class="btn btn-warning btn-sm mx-2">Edit</a>
                                                @endif
                                                @if (hasPermission('backend.category-delete'))
                                                    <a href="{{ route('backend.category-delete', $cat->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                @endif
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                            @endif
                        @endforeach
                    </tr> --}}
            @endforeach
        </div>
    </div>
@endsection
