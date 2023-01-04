@php

$meta_title = isset($meta_title) ? $meta_title : getSettingValue('meta_title');

$meta_description = isset($meta_description) ? $meta_description : getSettingValue('meta_description');

$meta_keyword = isset($meta_keyword) ? $meta_keyword : getSettingValue('meta_keyword');

$image = isset($image) ? $image : getSettingValue('image');

$type = isset($type) ? $type : "website";


@endphp

@stack('head')

 <title>{{ Request::url() == url('/') ? (getSettingValue('website_title') . " - " . getSettingValue('slogan')) : ($meta_title)}}</title>

<meta name="description" content="{{ $meta_description }}">
<meta name="theme-color" content="#111">
<meta name="msapplication-navbutton-color" content="#111">
<meta name="apple-mobile-web-app-status-bar-style" content="#111">
<meta property="og:site_name" content="{{ getSettingValue('website_title') }}">
<meta property="og:type" content="{{ $type }}">

<meta property="og:title" content="{{ $meta_title }}">

<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{ $meta_title }}">
<meta property="twitter:title" content="{{ $meta_title }}">
<meta property="twitter:description" content="{{ $meta_description }}">
<meta property="twitter:domain" content="{{ getSettingValue('website_title') }}">
<meta property="twitter:image" content="{{ asset($image) }}">
<link href="{{ Request::url() }}" rel="canonical">
