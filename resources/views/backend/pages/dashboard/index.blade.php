@extends('backend.layouts.index')

@push('styles')
    <!--plugins-->
    <link href="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/chartjs/chart.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/index.js"></script>
    <script>
        fetch("{{ route('backend.dashboard_table') }}").then(response => response.json()).then(r => {

            $("#table-holder").html(r.body);
        })
    </script>
@endpush


@section('content')
{{-- {{ dd(auth()->user()->role) }} --}}
    @if (auth()->user()->role->slug == 'super-admin')
        @include("backend.pages.dashboard.components.card")
        @include("backend.pages.dashboard.components.stat-table")
        @else
        @include("backend.pages.dashboard.components.writers-card")
    @endif
@endsection
