@extends('backend.layouts.index')


@push('styles')
    <!--plugins-->

    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
@endpush


@section('content')
    <div class="d-flex justify-content-between mb-2" style="align-items: baseline">
        {{-- <div class="col-"> --}}
        <h6 class="mb-0 text-uppercase">Settings </h6>

    </div>

    @php
    $type = Request()->type;
    @endphp


    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-primary" role="tablist">

                @foreach (config('constants.web_setting_tabs') as $key => $tag)
                    {{-- @if ($key > 0) --}}
                    {{-- {{ dd($tag) }} --}}
                    {{-- @endif --}}
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $type == $tag ? 'active' : '' }}"
                            href="{{ route('backend.setting-view', ['type' => $tag]) }}">
                            <div class="d-flex align-items-center">
                                <div class="tab-title">
                                    {{ unSlug($tag) }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content py-3">
                <div class="tab-pane fade active show mt-2" id="primaryhome" role="tabpanel">
                    <div class="">
                        <form class="row g-3" method="POST"
                            action="{{ route('backend.setting-update', ['type' => $type]) }}" enctype="multipart/form-data">
                            @include("backend.pages.setting.forms._$type")
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
