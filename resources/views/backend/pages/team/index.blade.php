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
                            <th> Image</th>
                            <th>Designation</th>
                            <th>Facebook Profile</th>
                            <th>Twitter Profile</th>
                            <th>Linkedin Profile</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $team)
                            {{-- {{ dd($team) }} --}}
                            <tr>
                                <td>
                                    {{ $team->name }}
                                </td>
                                <td>
                                    <img src="{{ asset($team->image) }}" alt="{{ $team->name }}" width="100px"
                                        height="100px">
                                </td>

                                <td>
                                    {{ $team->designation }}
                                </td>



                                <td>
                                    <a href="{{ $team->facebook }}" target="_blank" class="btn btn-sm btn-primary }}">
                                        <i class="bi bi-facebook"></i> Facebook
                                    </a>

                                </td>
                                <td>
                                    <a href="{{ $team->twitter }}" target="_blank" class="btn btn-sm btn-primary }}">
                                        <i class="bi bi-twitter"></i> Twitter
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $team->linkedin }}" target="_blank" class="btn btn-sm btn-primary }}">
                                        <i class="bi bi-linkedin"></i> Linkedin
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('backend.update-team-status', ['team' => $team->id]) }}"

                                        class="btn btn-sm btn-{{ $team->status == 1 ? 'success' : 'danger' }}">
                                        {{ $team->status == 1 ? 'Active' : 'InActive' }}
                                    </a>

                                </td>


                                <td>
                                    <a href="{{ route('backend.edit-team', $team->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('backend.delete-team', $team->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Client Name</th>
                            <th>Client Image</th>
                            <th>Title</th>
                            <th>Client Testimonial</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
