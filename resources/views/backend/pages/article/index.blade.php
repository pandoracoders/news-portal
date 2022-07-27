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
        <h6 class="mb-0 text-uppercase">article List</h6>
        {{-- </div> --}}
        {{-- <div class="left"> --}}
        <a href="{{ route('backend.article-create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
            Add article
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
                            <th>Image</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Info</th>
                            <th>Task Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>
                                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" width="100px"
                                        height="100px">
                                </td>
                                <td>
                                    {{ $article->slug }}
                                </td>
                                <td>
                                    {{ $article->category->title }}
                                </td>
                                <td>
                                    <span class="badge badge-pill btn-primary mr-3">
                                        {!! implode(
                                            "</span><span class='badge badge-pill btn-primary mr-3'>",
                                            $article->tags->pluck('title')->toArray(),
                                        ) !!}
                                    </span>

                                </td>
                                <td>
                                    <div>
                                        <span>Writer :</span> <span>{{ $article->writer->name }}</span>
                                    </div>

                                    @if ($article->editor)
                                        <div>
                                            <span>Editor :</span> <span>{{ $article->editor->name }}</span>
                                        </div>
                                    @endif
                                    @if ($article->editor)
                                        <div>
                                            <span>Editor :</span> <span>{{ $article->editor->name }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <span>Created at :</span> <span>{{ $article->created_at }}</span>
                                    </div>
                                    <div>
                                        <span>Updated at :</span> <span>{{ $article->updated_at }}</span>
                                    </div>

                                </td>

                                <td>
                                    @if ($article->published_at)
                                        <span class="badge badge-pill btn-success">{{ $article->published_at }}</span>
                                    @else
                                        <a href="#" class="badge badge-pill btn-danger">Request to publish</a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('backend.article-update_status', $article->id) }}" target="_blank"
                                        class="btn btn-sm btn-{{ $article->status == 1 ? 'success' : 'danger' }}">
                                        {{ $article->status == 1 ? 'Active' : 'InActive' }}
                                    </a>

                                </td>

                                <td>
                                    <a href="{{ route('backend.article-edit', $article->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('backend.article-delete', $article->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Slug</th>
                            <th>Order</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
