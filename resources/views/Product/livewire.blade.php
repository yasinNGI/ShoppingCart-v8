@extends('my_layout.app')

@section('custom-css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
@endsection

@section('content')
    <div class="container mt-5">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="my-3" style="font-size: 30px;">Product Livewire</h1>
            </div>
        </div>

        @livewire('lwproduct')
    </div>
@endsection

@section('custom-js')

    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            align: 'right',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timerProgressBar:true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert',({detail:{type,message}})=>{
            Toast.fire({
                icon:type,
                title:message
            })
        })
    </script>


@endsection
