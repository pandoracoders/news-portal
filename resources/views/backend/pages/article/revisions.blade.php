
@extends('backend.layouts.index')


@push('styles')
    <!--plugins-->

    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/datetime/jquery.datetimepicker.min.css') }}">
@endpush


@section('content')
    <div class="row">
        @isset($previous)
            <div class="col-md-6">
                <h3 style="margin-bottom: 20px; font-size: 20px; color: #ff731b;">Previous Version</h3><p style="margin-bottom:10px; color: #14ad21;">Saved on: {{ $previous->log_at }}</p>
                {!! json_decode($previous->article)->body??'' !!}
                <p>Total Words: {!! isset(json_decode($previous->article)->body)? str_word_count(json_decode($previous->article)->body):'' !!}</p>
            </div>
        @endisset
        <div class="col-md-6">
            <h3 style="margin-bottom: 20px; font-size: 20px; color: #00ef40;">Current Version</h3>
            <p style="margin-bottom:10px; color: #14ad21;">Saved on: {{ $articleLog->log_at }}</p>
            {!! json_decode($articleLog->article)->body?? '' !!}
            <p>Total Words: {!! isset(json_decode($articleLog->article)->body)? str_word_count(json_decode($articleLog->article)->body):'' !!}</p>
        </div>
    </div>
@endsection
