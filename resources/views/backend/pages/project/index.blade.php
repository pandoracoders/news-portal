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
    <br>
    <h6 class="mb-0 text-uppercase">DataTable Import</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> Name</th>
                            <th>Image</th>
                            <th>Service</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            {{-- {{ dd($project) }}  --}}
                            <tr>
                                <td>
                                    @if ($project->link)
                                        <a href="{{ $project->link }}" target="_blank">
                                            {{ $project->name }}
                                        </a>
                                    @else
                                        {{ $project->name }}
                                    @endif

                                </td>
                                <td>
                                    @if ($project->link)
                                        <a href="{{ $project->link }}" target="_blank">
                                            <img src="{{ asset($project->image) }}" alt="{{ $project->name }}"
                                                width="100px" height="100px">
                                        </a>
                                    @else
                                        <img src="{{ asset($project->image) }}" alt="{{ $project->name }}"
                                            width="100px" height="100px">
                                    @endif

                                </td>
                                <td>
                                    {{ $project->service->title }}
                                </td>
                                <td>
                                    <a href="{{ route('backend.update-project-status', ['project' => $project->id]) }}"
                                        class="btn btn-sm btn-{{ $project->status == 1 ? 'success' : 'danger' }}">
                                        {{ $project->status == 1 ? 'Active' : 'InActive' }}
                                    </a>

                                </td>


                                <td>
                                    <a href="{{ route('backend.edit-project', $project->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('backend.delete-project', $project->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th> Name</th>
                            <th>Image</th>
                            <th>Service</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
