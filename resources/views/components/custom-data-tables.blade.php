<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>

        <tr>
        <th scope="col">#</th>
        @foreach($cols as $key => $val)
            <th scope="col">{{$val}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        <?php
        ?>

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

                    @if(!in_array($val->id,$cart))
                        <div class="add_cart_div_1">
                            <button type="button" name="add_to_cart" product_id="{{$val->id}}"
                                    class="mt-1 add_to_cart btn btn-outline-primary btn-sm">Add to Cart
                            </button>
                        </div>
                    @endif
                    <div class="add_cart_div_2"></div>
                    @if(in_array($val->id,$cart))
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


{{--                <table id="example" class="table table-striped table-bordered" style="width:100%">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">#</th>--}}
{{--                        <th scope="col">Products</th>--}}
{{--                        <th scope="col">Price</th>--}}
{{--                        <th scope="col">Quantity</th>--}}
{{--                        <th scope="col">action</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @forelse($products as $key => $val)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">{{$val->id}}</th>--}}
{{--                            <td>--}}
{{--                                {{ucwords($val->title)}}--}}
{{--                                <span class="d-block">--}}
{{--                                        @if( $val->image !== null )--}}
{{--                                        <img src="{{asset('storage/'.$val->image)}}" alt="" width="100" height="50">--}}
{{--                                    @else--}}
{{--                                        <img src="{{asset('others/images/placeholder.png')}}" alt="" width="100"--}}
{{--                                             height="50">--}}
{{--                                    @endif--}}
{{--                                    </span>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <span class="product_price" price="{{$val->price}}">{{$val->price}}</span>--}}
{{--                            </td>--}}
{{--                            <td class="section_cart">--}}
{{--                                <input type="number" name=""--}}
{{--                                       class="product_quantity rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"--}}
{{--                                       min="1" max="20">--}}
{{--                            </td>--}}
{{--                            <td style="position: relative;">--}}
{{--                                <a href="{{route('product_edit' , $val->id)}}" class="btn btn-outline-success btn-sm">Edit</a>--}}
{{--                                <form action="{{route('product_delete',$val->id)}}" method="post" class="d-inline">--}}
{{--                                    @csrf--}}
{{--                                    <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">--}}
{{--                                </form>--}}

{{--                                @if(!in_array($val->id,$cart_products))--}}
{{--                                    <div class="add_cart_div_1">--}}
{{--                                        <button type="button" name="add_to_cart" product_id="{{$val->id}}"--}}
{{--                                                class="mt-1 add_to_cart btn btn-outline-primary btn-sm">Add to Cart--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                <div class="add_cart_div_2"></div>--}}

{{--                                @if(in_array($val->id,$cart_products))--}}
{{--                                    <div class="remove_cart_div_1">--}}
{{--                                        <button type="button" name="remove_from_cart" product_id="{{$val->id}}"--}}
{{--                                                class="mt-1 remove_from_cart btn btn-outline-warning btn-sm">Remove Item--}}
{{--                                        </button>--}}
{{--                                    </div>--}}

{{--                                @endif--}}
{{--                                <div class="remove_cart_div_2"></div>--}}

{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}