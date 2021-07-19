<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('my_layout.head')

@yield('custom-css')


<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">

@php
    use Illuminate\Support\Facades\Cookie;
    $cookie_data   = Cookie::get('cart');
    $cart          = !empty( json_decode($cookie_data) ) ? json_decode($cookie_data) : [];
@endphp

@include('my_layout.header')

<!-- Page Content -->
    <main class="mt-5">
        @yield('content')
    </main>

</div>


@include('my_layout.scripts')

<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info')  }}";
        switch (type) {

            case 'info':
                toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                };
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.options = {
                    "closeButton" : true,
                    "progressBar" : true
                };
                toastr.success("{{Session::get("message")}}");
                break;
            case 'warning':
                toastr.options = {
                    "closeButton" : true,
                    "progressBar" : true
                };
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.options = {
                    "closeButton" : true,
                    "progressBar" : true
                };
                toastr.error("{{Session::get("message")}}");
                break;
        }
    @endif
</script>


@yield('custom-js')
</body>
</html>
