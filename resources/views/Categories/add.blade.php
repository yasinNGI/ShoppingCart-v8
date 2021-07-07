@extends('my_layout.app')


@section('custom-css')

@endsection


@section('content')
    <div class="container">

        <div class="row my-3">
            <div class="col-lg-12 text-center">
                <h1  class="my-3" style="font-size: 30px;">Add Product</h1>
            </div>
        </div>

        @include('Categories.Category-Component.header_with_buttons')

        @if (session('exception_error'))
            <div class="alert alert-danger my-5">{{ session('exception_error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-12 mt-4 text-center">
                @if(Session::has('error'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                @endif
            </div>
        </div>

        <div class="row mt-5">


            <div class="col-md-6">
                <form action="{{route('category_store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Category Name:</label>
                        <input type="text" name="cat_name" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('cat_name') is-invalid @enderror">
                        @error('cat_name')
                            <span class="invalid-feedback d-block" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Parent Category:</label>
                        <select class="form-control" name="parent_category">
                            <option value="">None</option>
                            @if ($getCategoryTop->count())

                                @foreach($getCategoryTop as $key => $category)

                                    @if (!empty($getCategoryAll[$category->id]))

                                        <option value="{{$category->id}}">{{$category->name}}</option>

                                        @foreach($getCategoryAll[$category->id] as $childCategory)
                                            <option value="{{$childCategory->id}}">
                                                -{{$childCategory->name}}</option>

                                            @if(!empty($getCategoryAll[$childCategory->id]))

                                                @foreach( $getCategoryAll[$childCategory->id] as $childCategory2 )
                                                    <option value="{{$childCategory2->id}}">
                                                        -- {{$childCategory2->name}}</option>
                                                @endforeach

                                            @endif

                                        @endforeach
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach

                            @endif
                        </select>

                    </div>

                    <div class="form-group">
                        <input type="submit" name="btn_submit_category" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" value="Create">
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