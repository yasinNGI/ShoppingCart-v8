<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="row mt-5">
        <div class="col-md-6">

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif


            @if($updateMode)
                @include('livewire.product.update')
            @else
                @include('livewire.product.create')
            @endif
        </div>
    </div>

    <div class="row mt-5 h-100 justify-content-center align-items-center">
        <div class="col-8">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                <?php
                ?>
                @forelse($products as $key => $val)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <th scope="row">{{$val->id}}</th>
                        <td>{{ucwords($val->title)}}</td>
                        <td><span class="product_price" price="{{$val->price}}">{{$val->price}}</span></td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
