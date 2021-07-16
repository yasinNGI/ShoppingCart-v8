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
                <h1 style="font-size: 30px;">Cart Items</h1>
            </div>
        </div>

        @include('Product.Product-Components.header_with_buttons')

        @if (session('exception_error'))
            <div class="alert alert-danger my-5">{{ session('exception_error') }}</div>
        @endif


        <div class="row my-5">

            <div class="col-8 mx-auto">
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
                    @forelse($data as $key => $prod)
                        @php
                               $val = getProduct($prod->product_id);
                        @endphp
                        <tr>
                            <th scope="row">{{$key+1}}</th>
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
                                <span class="product_price">{{$prod->price}}</span>
                            </td>
                            <td class="section_cart">
                                 <span>{{$prod->quantity}}</span>
                            </td>
                            <td style="position: relative;">
                                <form action="{{route('product_remove_from_cart', $val->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="form" value="non_ajax">
                                    <input type="hidden" name="status" value="remove">
                                    <button type="submit" name="remove_from_cart"
                                            class="mt-1 remove_from_cart btn btn-outline-warning btn-sm">Remove Item
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
                <br>
                <a href="" style="position: absolute;right: 13px; top: 235px;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Checkout</a>

            </div>
        </div>

    </div>
@endsection


@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
