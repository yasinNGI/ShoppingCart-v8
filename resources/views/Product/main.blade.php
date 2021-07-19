@extends('my_layout.app')

@section('custom-css')
@endsection

@section('content')
    <div class="container mt-5">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="my-3" style="font-size: 30px;">Product Section</h1>
            </div>
        </div>

        <x-main-page-buttons :btnArr="$buttons" />

{{--        <x-main-page-buttons btnTextOne="Add Product" btnUrlOne="{{route('product_add')}}" btnTextTwo="View All" btnUrlTwo="{{route('product_all')}}" >--}}
{{--        </x-main-page-buttons>--}}


{{--        @livewire('lwproduct')--}}
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function(){
            // alert('dff');
        });
    </script>
@endsection