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
        <h6 class="mb-0 text-uppercase">Article Title</h6>
        {{-- </div> --}}
        {{-- <div class="left"> --}}
        <a href="{{ route('backend.article_title-create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
            Add Title
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
                            <th>Picked By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($article_titles as $article_title)
                            <tr>
                                <td>{{ $article_title->title }}</td>

                                <td>
                                    {{ $article_title->article?->writer->name }}
                                </td>

                                {{-- only with update and delete permission --}}
                                <td>
                                    <a href="{{ route('backend.article_title-update_status', $article_title->id) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-{{ $article_title->status == 1 ? 'success' : 'danger' }}">
                                        {{ $article_title->status == 1 ? 'Active' : 'InActive' }}
                                    </a>

                                </td>

                                <td>
                                    <a href="{{ route('backend.article_title-edit', $article_title->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('backend.article_title-delete', $article_title->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    @if (!$article_title->article_id)
                                        <a href="{{ route('backend.article_title-pick', $article_title->id) }}"
                                            class="btn btn-primary btn-sm">Pick Topic</a>
                                    @else
                                    @endif

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Picked By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
