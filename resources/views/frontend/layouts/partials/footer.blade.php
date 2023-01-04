<footer class="footer-section">
    <div class="footer-content pt-3 pb-3">
        <div class="row">
            <div class="col-lg-6 mb-50 d-none d-lg-block">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <h2>
                            <a href="{{ url('/') }}">
                                {{ getSettingValue('website_title') }}
                            </a>
                        </h2>
                    </div>

                </div>
            </div>
            <div class="col-md-6 mb-30 social-section">
                <div class="footer-social-icon">
                    {{-- {{ dd(getSettingType("social-media")) }} --}}
                    @forelse (getSettingType("social-media") as $media)
                        <a href="{{ $media->value }}">
                            <i class="fa-brands fa-{{ $media->key }}"></i>
                        </a>
                    @empty
                    @endforelse


                </div>
            </div>

        </div>
        <div class="row copyright-section mt-3">
            <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                <div class="copyright-text">
                    <p>&copy; Copyright {{ date('Y') }} <a
                            href="/">{{ getSettingValue('website_title') }}</a>. All Right Reserved</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <ul>
                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/about-us">About Us</a></li>
                    <li><a href="contact-us">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
