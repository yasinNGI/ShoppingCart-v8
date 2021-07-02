@extends('my_layout.app')


@section('custom-css')

    <style>
        /*.remove_cart_div {*/
        /*    position: absolute;*/
        /*    top: 12px;*/
        /*    right: 131px;*/
        /*}*/

        /*.add_cart_div {*/
        /*    position: absolute;*/
        /*    top: 12px;*/
        /*    right: 140px;*/
        /*}*/

    </style>

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
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
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
                                <span class="product_price" price="{{$val->price}}">{{$val->price}}</span>
                            </td>
                            <td class="section_cart">
                                <input type="number" name=""
                                       class="product_quantity rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                       min="1" max="20">
                            </td>
                            <td style="position: relative;">
                                <a href="{{route('product_edit' , $val->id)}}" class="btn btn-outline-success btn-sm">Edit</a>
                                <form action="{{route('product_delete',$val->id)}}" method="post" class="d-inline">
                                    @csrf
                                    <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                                </form>

                                @if(!in_array($val->id,$cart_products))
                                    <div class="add_cart_div_1">
                                        <button type="button" name="add_to_cart" product_id="{{$val->id}}"
                                                class="mt-1 add_to_cart btn btn-outline-primary btn-sm">Add to Cart
                                        </button>
                                    </div>
                                @endif
                                <div class="add_cart_div_2"></div>

                                @if(in_array($val->id,$cart_products))
                                    <div class="remove_cart_div_1">
                                        <button type="button" name="remove_from_cart" product_id="{{$val->id}}"
                                                class="mt-1 remove_from_cart btn btn-outline-warning btn-sm">Remove Item
                                        </button>
                                    </div>

                                @endif
                                <div class="remove_cart_div_2"></div>

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

            var cart_element        = $("#cart_item");

            $('body').on('click' , '.add_to_cart' , function () {
                var _self           = $(this);
                var status          = 'add';
                var product_id      = $(this).attr('product_id');
                var cart_attr       = $(this).parent().parent().parent().find('.product_quantity');
                var cart_value      = $(this).parent().parent().parent().find('.product_quantity').val();
                var price           = $(this).parent().parent().parent().find('.product_price').attr('price');
                var route           = "{{route('product_add_to_cart', ['id'=>'id'])}}";
                route               = route.replace('id', product_id);
                var remove_item_btn = '<button type="button" name="remove_from_cart" product_id="'+product_id+'" class="mt-1 remove_from_cart btn btn-outline-warning btn-sm">Remove Item</button>';

                $.ajax({
                    url: route,
                    type: 'post',
                    data: {status: status , quantity:cart_value , price:price},
                    success: function (res) {
                        cart_element.text( '('+res.count+')' );
                        _self.hide();
                        _self.parent().parent().find('.remove_cart_div_2').append(remove_item_btn);
                        cart_attr.attr('disabled','disabled');
                        cart_attr.val('');
                    }
                });
            });

            $('body').on('click' ,'.remove_from_cart' , function () {
                var _self           = $(this);
                var status          = 'remove';
                var product_id      = $(this).attr('product_id');
                var cart_attr       = $(this).parent().parent().parent().find('.product_quantity');
                var route           = "{{route('product_remove_from_cart', ['id'=>'id'])}}";
                route               = route.replace('id', product_id);
                var add_item_btn    = '<button type="button" name="add_to_cart" product_id="'+product_id+'" class="mt-1 add_to_cart btn btn-outline-primary btn-sm">Add to Cart</button>';

                $.ajax({
                    url: route,
                    type: 'post',
                    data: {status: status , form:"ajax"},
                    success: function (res) {
                        cart_element.text( '('+res.count+')' );
                        _self.hide();
                        _self.parent().parent().parent().find('.add_cart_div_2').append(add_item_btn);
                        cart_attr.removeAttr('disabled');
                    }
                });
            });

        });
    </script>
@endsection
