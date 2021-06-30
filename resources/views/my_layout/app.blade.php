<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('my_layout.head')

@yield('custom-css')

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

{{--        @include('layouts.navigation')--}}

{{--        <!-- Page Heading -->--}}
{{--        <header class="bg-white shadow">--}}
{{--            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                {{ $header }}--}}
{{--                @include('my_layout.header')--}}
{{--            </div>--}}
{{--        </header>--}}

{{--        <!-- Page Content -->--}}
{{--        <main>--}}
{{--            {{ $slot }}--}}
{{--            @yield('content')--}}
{{--        </main>--}}

    </div>

    @include('my_layout.scripts')

    @yield('custom-js')
</body>
</html>
