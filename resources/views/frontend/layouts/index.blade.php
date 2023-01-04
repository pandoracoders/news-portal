<!DOCTYPE html>
<html lang="en">

<head>
    {!! getSettingValue('google_tag_manager_code') !!}
    {!! getSettingValue('google_analytics_code') !!}
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset(getSettingValue('favicon')) }}" sizes="64x64">

    @include('frontend.layouts.partials.head')
    {{-- Google Font --}}


    {{-- Common Css --}}
    {{-- @include('frontend.assets.css.bootstrap')
    @include('frontend.assets.css.fontawesome')
    @include('frontend.assets.css.style') --}}
    @stack('styles')
    @stack('schema')
</head>

<body>
    {!! getSettingValue('gtm_body_code') !!}
    @include('frontend.layouts.partials.header')
    <div class="sidebar-overlay"></div>
    <div id="headerAd" class="adver container text-center">
    </div>
    @yield('content')
    <div id="footerAd" class="adver container text-center">
    </div>
    @include('frontend.layouts.partials.footer')
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
    @include('frontend.assets.js.script')
    @include('frontend.assets.js.main')
    @stack('scripts')
</body>

</html>
