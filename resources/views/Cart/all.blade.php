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
