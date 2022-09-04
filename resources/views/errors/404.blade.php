@extends('frontend.layouts.index')

@push('styles')
<link rel="stylesheet" href="{{ asset('') }}frontend/css/error.min.css" type="text/css">
@endpush


@section('content')
    <main class="container">
        <div id="notfound">
            <div class="notfound-bg"></div>
            <div class="notfound">
                <div class="notfound-404">
                    <h1>404</h1>
                </div>
                <h2>Oops! Page Not Found!</h2>
                <h2>The page you are looking for does not exist or has been removed!

                </h2>
                <form class="notfound-search">
                    <input type="text" placeholder="Search...">
                    <button type="button">Search</button>
                </form>
                <div class="notfound-social">
                    <a href="#" target="_blank">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="#" target="_blank">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#" target="_blank">
                        <i class="fa-brands fa-pinterest"></i>
                    </a>
                </div>
                <a href="{{ url('/') }}">Back To Homepage</a>
            </div>
        </div>
    </main>
@endsection
