@extends('backend.layouts.index')


@push('styles')
    <!--plugins-->

    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <link href="{{ asset('backend') }}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />


    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
@endpush


@section('content')
    {{-- @include("backend.layouts.partials.breadcrumb", [
        "title" => "DataTable Import",
        "items" => [
            [
                "text" => "Home",
                "url" => "#",
                "active" => false
            ],
            [
                "text" => "Components",
                "url" => "#",
                "active" => false
            ],
            [
                "text" => "DataTable Import",
                "url" => "#",
                "active" => true
            ]
        ]
    ]) --}}

    @include('backend.pages.role.forms._form')
@endsection
