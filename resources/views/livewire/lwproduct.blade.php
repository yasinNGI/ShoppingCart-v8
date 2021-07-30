<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="row text-left">
        <div class="col-md-6">
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
                    <th scope="col">Action</th>
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
                        <td>
                            <button wire:click="edit({{$val->id}})" class="btn btn-outline-primary btn-sm">Edit</button>
                            <button onclick="deleteProduct({{$val->id}})" class="btn btn-outline-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function deleteProduct(id){
        if(confirm("Are you sure to delete this record?"))
            window.livewire.emit('deleteProduct',id);
    }
</script>