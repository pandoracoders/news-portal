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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Icon</th>
                            <th> Excerpt </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->title }}</td>
                                <td>
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" width="100px"
                                        height="100px">
                                </td>
                                <td>


                                </td>
                                <td>
                                  <p>
                                    {{ $service->excerpt }}
                                  </p>

                                <td>
                                    <a href="{{ route('backend.update-service-status', $service->id) }}" target="_blank"
                                        class="btn btn-sm btn-{{ $service->status == 1 ? 'success' : 'danger' }}">
                                        {{ $service->status == 1 ? 'Active' : 'InActive' }}
                                    </a>

                                </td>

                                <td>
                                    <a href="{{ route('backend.edit-service', $service->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('backend.delete-service', $service->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Icon</th>
                            <th> Excerpt </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
