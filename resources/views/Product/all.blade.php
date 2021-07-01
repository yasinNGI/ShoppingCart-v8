@extends('my_layout.app')


@section('custom-css')

@endsection


@section('content')
    <div class="container">

        <div class="row my-3">
            <div class="col-lg-12 text-center">
                <h1 style="font-size: 30px;">All Product</h1>
            </div>
        </div>

        @include('Product.Product-Components.header_with_buttons')

        <div class="row">
            <div class="col-lg-12 mt-4 text-center">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                @endif
            </div>
        </div>

        <div class="row my-5">

            <div class="col-lg-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Products</th>
                        <th scope="col">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $key => $val)
                        <tr>
                            <th scope="row">{{$val->id}}</th>
                            <td>
                                {{ucwords($val->title)}}
                                <span class="d-block">
                                        @if( $val->image !== null )
                                        <img src="{{asset('storage/'.$val->image)}}" alt="" width="100" height="50">
                                    @else
                                        <img src="{{asset('others/images/placeholder.png')}}" alt="" width="100"
                                             height="50">
                                    @endif
                                    </span>
                            </td>
                            <td>
                                <a href="{{route('product_edit' , $val->id)}}" class="btn btn-outline-success btn-sm">Edit</a>
                                <form action="{{route('product_delete',$val->id)}}" method="post" class="d-inline">
                                    @csrf
                                    <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                                </form>
                                <button type="button" name="add_to_cart" product_id="{{$val->id}}"
                                        class="add_to_cart btn btn-outline-primary btn-sm">Add to Cart
                                </button>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 text-center">
                {{ $products->links() }}
            </div>

        </div>

    </div>
@endsection


@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.add_to_cart').click(function () {

                var product_id = $(this).attr('product_id');
                var route = "{{route('product_add_to_cart', ['id'=>'id'])}}";
                route = route.replace('id', product_id);

                var status = 'add';

                $.ajax({
                    url: route,
                    type: 'post',
                    data: {status: status},
                    success: function (res) {
                        console.log(res);
                    }
                });
            });

        });
    </script>
@endsection