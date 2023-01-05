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

       <div>
            @if (hasPermission('backend.article_title-create'))
                <a href="{{ route('backend.article_title-create_and_publish') }}" class="btn btn-secondary text-white">
                    Create & Publish
                </a>
                <a href="{{ route('backend.article_title-create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                    + Create Topic
                </a>
            @endif
       </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Picked By</th>
                            @if (hasPermission('backend.article_title-update_status'))
                                <th>Status</th>
                            @endif
                            @if (hasPermission('backend.article_title-edit') ||
                                hasPermission('backend.article_title-delete') ||
                                hasPermission('backend.article_title-pick'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($article_titles as $article_title)

                            <tr>
                                <td>{{ $article_title->title }}</td>

                                <td>
                                    {{ $article_title->article?->writer->name }}
                                </td>

                                @if (hasPermission('backend.article_title-update_status'))
                                    <td>
                                        <a href="{{ route('backend.article_title-update_status', $article_title->id) }}"

                                            class="btn btn-sm btn-{{ $article_title->status == 1 ? 'success' : 'danger' }}">
                                            {{ $article_title->status == 1 ? 'Active' : 'InActive' }}
                                        </a>
                                    </td>
                                @endif

                                @if (hasPermission('backend.article_title-edit') ||
                                    hasPermission('backend.article_title-delete') ||
                                    hasPermission('backend.article_title-pick'))
                                    <td>
                                        <div class="btn-group">
                                            @if (hasPermission('backend.article_title-edit'))
                                                <a href="{{ route('backend.article_title-edit', $article_title->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @endif

                                            @if (hasPermission('backend.article_title-pick'))
                                                @if (!$article_title->article_id)
                                                    <a href="{{ route('backend.article_title-pick', $article_title->id) }}"
                                                        class="btn btn-primary btn-sm">Pick Topic</a>
                                                @else
                                                    <span class="btn btn-success btn-sm">Picked</span>
                                                @endif
                                            @endif

                                            @if(in_array('assign_task',auth()->user()->permission['permissions']) && !$article_title->article_id)
                                                <a data-bs-toggle="modal" href={{"#assign-topic_".$article_title->id}}  class="btn btn-info btn-sm mx-1">
                                                    Assign Topic
                                                </a>

                                                {{-- Assign Topic to Writer Modal --}}
                                                <div class="modal fade" id="{{"assign-topic_".$article_title->id}}" tabindex="-1" aria-hidden="true">
                                                    <form action="{{ route('backend.article_title-assign', $article_title->id) }}" method="post">
                                                        @csrf
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Choose Writer</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 mb-2 ">
                                                                            <label class="form-label">{{ $article_title->title }}</label>
                                                                            <select name="assigned_user" class="form-control tag-select" id="assign-topic"
                                                                                aria-placeholder="Select Writer">
                                                                                <option value="">Select User</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id}}">{{ $user->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                                        aria-label="Close">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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
                            <th>Picked By</th>
                            @if (hasPermission('backend.article_title-update_status'))
                                <th>Status</th>
                            @endif
                            @if (hasPermission('backend.article_title-edit') ||
                                hasPermission('backend.article_title-delete') ||
                                hasPermission('backend.article_title-pick'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection
