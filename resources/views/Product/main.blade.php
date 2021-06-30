@extends('my_layout.app')


@section('custom-css')

@endsection


@section('content')
    <div class="container">

        <div class="row my-3">
            <div class="col-lg-12 text-center">
                <h1 style="font-size: 30px;">Product Section</h1>
            </div>
        </div>

        @include('Product.Product-Components.header_with_buttons')

        </div>
    </div>
@endsection


@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function(){
            // alert('dff');
        });
    </script>
@endsection