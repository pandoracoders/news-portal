@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/notifications/css/lobibox.min.css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/notifications/js/notifications.min.js"></script>


    @if (session()->has('success'))
        <script>
            function round_success_noti() {
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-check-circle',
                    delayIndicator: false,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
                });
            }
        </script>
    @endif
@endpush


hello everyone
