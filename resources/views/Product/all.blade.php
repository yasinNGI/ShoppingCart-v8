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
                <h1 class="my-3" style="font-size: 30px;">All Product</h1>
            </div>
        </div>

        <x-main-page-buttons btnTextOne="Add Product" btnUrlOne="{{route('product_add')}}" btnTextTwo="View All" btnUrlTwo="{{route('product_all')}}"/>

        @if (session('exception_error'))
            <div class="alert alert-danger my-5">{{ session('exception_error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-12 mt-4 text-center">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                @endif
            </div>
        </div>

        <div class="row my-5">

            <div class="col-lg-12">
                <x-custom-data-tables :cols="$table_cols" :products="$products" :other_data="$cart_products"
                                      page="all_product"/>
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

            var cart_element = $("#cart_item");

            $('body').on('click', '.add_to_cart', function () {
                var _self = $(this);
                var status = 'add';
                var product_id = $(this).attr('product_id');
                var cart_attr = $(this).parent().parent().parent().find('.product_quantity');
                var cart_value = $(this).parent().parent().parent().find('.product_quantity').val();
                var price = $(this).parent().parent().parent().find('.product_price').attr('price');
                var route = "{{route('product_add_to_cart', ['id'=>'id'])}}";
                route = route.replace('id', product_id);
                var remove_item_btn = '<button type="button" name="remove_from_cart" product_id="' + product_id + '" class="mt-1 remove_from_cart btn btn-outline-warning btn-sm">Remove Item</button>';

                $.ajax({
                    url: route,
                    type: 'post',
                    data: {status: status, quantity: cart_value, price: price},
                    success: function (res) {
                        cart_element.text('(' + res.count + ')');
                        _self.hide();
                        _self.parent().parent().find('.remove_cart_div_2').append(remove_item_btn);
                        cart_attr.attr('disabled', 'disabled');
                        cart_attr.val('');
                    },
                    error: function(data){
                        var error = data.responseJSON;
                        err_msg = "Exception : " + error.errors.toString();
                        alert(err_msg);
                    }
                });
            });

            $('body').on('click', '.remove_from_cart', function () {
                var _self = $(this);
                var status = 'remove';
                var product_id = $(this).attr('product_id');
                var cart_attr = $(this).parent().parent().parent().find('.product_quantity');
                var route = "{{route('product_remove_from_cart', ['id'=>'id'])}}";
                route = route.replace('id', product_id);
                var add_item_btn = '<button type="button" name="add_to_cart" product_id="' + product_id + '" class="mt-1 add_to_cart btn btn-outline-primary btn-sm">Add to Cart</button>';

                $.ajax({
                    url: route,
                    type: 'post',
                    data: {status: status, form: "ajax"},
                    success: function (res) {
                        cart_element.text('(' + res.count + ')');
                        _self.hide();
                        _self.parent().parent().parent().find('.add_cart_div_2').append(add_item_btn);
                        cart_attr.removeAttr('disabled');
                    }
                });
            });

        });
    </script>
@endsection
