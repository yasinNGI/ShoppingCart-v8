@extends('my_layout.app')


@section('custom-css')

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1  class="my-3" style="font-size: 30px;">Category Section</h1>
            </div>
        </div>

        @include('Categories.Category-Component.header_with_buttons')

    </div>
@endsection


@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function(){
            // alert('dff');
        });
    </script>
@endsection