@include('layouts.web.head')

<body class="font-sans antialiased">
    @include('layouts.web.header')

    @yield('content')

    @include('layouts.web.footer')
<script src="{{ asset('assets/libs/js/jquery.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: 'var(--primary-color)',
            customClass: {
                popup: 'colored-toast'
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
    @stack('scripts')
</body>

</html>