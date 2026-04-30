@include('layouts.web.head')

<body class="font-sans antialiased">
    @include('layouts.web.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.web.footer')
</body>

</html>
