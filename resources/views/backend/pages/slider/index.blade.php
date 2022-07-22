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
                            <th>Button 1</th>
                            <th>Button 2</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->title }}</td>
                                <td>
                                    <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" width="100px"
                                        height="100px">
                                </td>
                                <td>
                                    <a href="{{ $slider->btn_1_url }}" target="_blank">
                                        {{ $slider->btn_1_text }}</a>

                                </td>
                                <td>
                                    <a href="{{ $slider->btn_2_url }}" target="_blank">
                                        {{ $slider->btn_2_text }}
                                    </a>

                                <td>
                                    <a href="{{ route('backend.update-slider-status', ['slider' => $slider->id]) }}"
                                        class="btn btn-sm btn-{{ $slider->status == 1 ? 'success' : 'danger' }}">
                                        {{ $slider->status == 1 ? 'Active' : 'InActive' }}
                                    </a>

                                </td>

                                <td>
                                    <a href="{{ route('backend.edit-slider', $slider->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('backend.delete-slider', $slider->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Button 1</th>
                            <th>Button 2</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
