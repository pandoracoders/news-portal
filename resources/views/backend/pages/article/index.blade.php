@extends('backend.layouts.index')

@include('backend.datatable')



@push('styles')
    <!--plugins-->
    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px !important;
            margin-bottom: 25px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

            background: transparent !important;
            border: none !important;
        }
    </style>
@endpush

@push('scripts')
    <!--plugins-->

    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/table-datatable.js"></script>

    {{ $dataTable->scripts() }}


    <script>
        $(document).ready(function() {
            window.table = window.LaravelDataTables[Object.keys(window.LaravelDataTables)[0]];

        });



        $(document).on("change", ".table-filter", function() {
            window.table.ajax.url(window.location.href + "?" + $(this).serialize()).load();
            // window.table.ajax.reload();
        })

        $(document).ready(function() {
            $(document).on("change", "input:checkbox", function() {
                $.ajax($(this).data("url"));
            })

        });
    </script>
@endpush


@php
$tabs = [...['all'], ...config('constants.task_status')];
if (in_array(auth()->user()->role->title, ['Editor'])) {
    $tabs = array_diff($tabs, ['writing']);
}
@endphp


@section('content')
    <div class="d-flex justify-content-between mb-2" style="align-items: baseline">
        {{-- <div class="col-"> --}}
        <h6 class="mb-0 text-uppercase">Article List</h6>
        {{-- </div> --}}
        {{-- <div class="left"> --}}
        {{-- <a href="{{ route('backend.article-create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
            Add article
        </a> --}}
        {{-- </div> --}}
    </div>

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-primary" role="tablist">
                @foreach ($tabs as $key => $task)
                    <li class="nav-item" role="presentation">
                        @if (Request()->task_status)

                            <a class="nav-link {{ Request()->task_status == $task ? 'active' : '' }}"
                                href="{{ route('backend.article-view', ['task_status' => $task == 'all' ? '' : $task]) }}">


                                <div class="d-flex align-items-center">
                                    <div class="tab-title">
                                        @if($task == 'autopublish')
                                            @if (in_array('autopublish',auth()->user()->permission['permissions']))

                                                Autopublish
                                                @if ($key != 0)
                                                    <span class="badge badge-primary" style="">
                                                        {{ array_key_exists($task, $counts) ? $counts[$task]['count'] : 0 }}
                                                    </span>
                                                @endif

                                            @endif
                                        @else
                                            {{ $task == 'submitted' ? (auth()->user()->isWriter ? ucwords($task) : 'Open') : ucwords($task) }}
                                            @if ($key != 0)
                                            <span class="badge badge-primary" style="">
                                                {{ array_key_exists($task, $counts)? $counts[$task]['count'] : 0 }}
                                            </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @else
                            <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                href="{{ route('backend.article-view', ['task_status' => $task == 'all' ? '' : $task]) }}">

                                <div class="d-flex align-items-center">
                                    <div class="tab-title">

                                        @if($task == 'autopublish')
                                            @if (in_array('autopublish',auth()->user()->permission['permissions']))

                                                Autopublish
                                                @if ($key != 0)
                                                    <span class="badge badge-primary" style="">
                                                        {{ array_key_exists($task, $counts) ? $counts[$task]['count'] : 0 }}
                                                    </span>
                                                @endif

                                            @endif
                                        @else

                                            {{ $task == 'submitted' ? (auth()->user()->isWriter ? ucwords($task) : 'Open') : ucwords($task) }}
                                            @if ($key != 0)
                                            <span class="badge badge-primary" style="">
                                                {{ array_key_exists($task, $counts) ? $counts[$task]['count'] : 0 }}
                                            </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
            <div class="tab-content py-3">
                <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                    <div class="table-striped table-bordered table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
