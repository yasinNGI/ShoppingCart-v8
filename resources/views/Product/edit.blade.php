@extends('my_layout.app')


@section('custom-css')

@endsection


@section('content')
    <div class="container">

        <div class="row my-3">
            <div class="col-lg-12 text-center">
                <h1  class="my-3" style="font-size: 30px;">Edit Product</h1>
            </div>
        </div>


        <x-main-page-buttons btnTextOne="Add Product" btnUrlOne="{{route('product_add')}}" btnTextTwo="View All" btnUrlTwo="{{route('product_all')}}"  />

        <div class="row mt-5">

            <div class="col-md-6">
                <form action="{{route('product_update' , $product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name:</label>
                        <input type="text" name="product_title" value="{{$product->title}}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('product_title') is-invalid @enderror">

                        @error('product_title')
                        <span class="invalid-feedback d-block" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                    </div>

                    <div class="form-group">
                        <label for="">Description:</label>
                        <textarea name="product_desc" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="" cols="30" rows="10">{{$product->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Product Image</label>
                        <span class="d-block my-4">
                            @if( $product->image == null )
                                <span>Image not available</span>
                            @else
                                <img src="{{asset('storage/'.$product->image)}}" width="200" height="150" alt="">
                            @endif
                            <input type="hidden" name="product_old_image" value="{{$product->image}}">
                        </span>
                        <input type="file" class="form-control-file" name="product_image" id="exampleFormControlFile1">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="btn_submit_product" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" value="Update">
                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection


@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function () {
            // alert('dff');
        });
    </script>
@endsection