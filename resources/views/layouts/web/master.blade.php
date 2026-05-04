@include('layouts.web.head')

<body class="font-sans antialiased">
    @include('layouts.web.header')

        @yield('content')

    @include('layouts.web.footer')

    @stack('scripts')
</body>

</html>
