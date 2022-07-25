@extends('auth.layouts')


@section('content')
    <div class="login-cover-wrapper">
        <div class="card shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <h4>2FA Secret Key</h4>
                    <p>Open up your 2FA mobile app and scan the following QR barcode:</p>
                </div>
                <div class="row">
                    <div class="image-holder">
                        {!! $image !!}
                    </div>
                    <div>
                        <div class="alert">
                            <div class="alert-info">
                                <div class="alert-message">
                                    <p>
                                        If your 2FA mobile app does not support QR barcodes,
                                        enter in the following number: <code>{{ $secret }}</code>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12">
                        <div class="d-grid">
                            <a href="{{ route('validate-2fa') }}" class="btn btn-dark">Validate OTP</a>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
