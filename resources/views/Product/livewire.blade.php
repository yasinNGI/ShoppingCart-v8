@extends('my_layout.app')

@section('custom-css')
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
@endsection
