<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('my_layout.head')

@yield('custom-css')


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        @include('my_layout.header')

        <!-- Page Content -->
        <main class="mt-5">
            @yield('content')
        </main>

    </div>

    @include('my_layout.scripts')

    @yield('custom-js')
</body>
</html>
