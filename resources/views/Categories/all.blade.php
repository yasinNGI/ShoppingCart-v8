@extends('my_layout.app')


@section('custom-css')

@endsection


@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-12 text-center">
                <h1 style="font-size: 30px;">All Category</h1>
            </div>
        </div>

        @include('Categories.Category-Component.header_with_buttons')

        <div class="row">
            <div class="col-lg-12 mt-4 text-center">
                @if(Session::has('message'))
                    <x-alert type="success" message="{{ Session::get('message')}}" />
                @endif
            </div>
        </div>

        <div class="row mt-5">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Parent</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $key => $val)
                    <tr>
                        <th scope="row">{{$val->id}}</th>
                        <td>
                            {{ucwords($val->name)}}
                        </td>
                        <td>
                            {{getCategoryName($val->parent)}}
                        </td>
                        <td>
                            <a href="{{route('category_edit' , $val->id)}}" class="btn btn-outline-success">Edit</a>
                            <form action="{{route('category_delete',$val->id)}}" method="post" class="d-inline">
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-outline-danger">
                            </form>
                        </td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
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