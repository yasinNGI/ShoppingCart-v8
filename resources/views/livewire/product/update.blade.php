<form>
    @csrf
    <div class="form-group">
        <label for="">Name:</label>
        <input type="text" wire:model="title" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('title') is-invalid @enderror">

        @error('title')
        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Price:</label>
        <input type="text" wire:model="price" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('price') is-invalid @enderror">
        @error('price')
        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Description:</label>
        <textarea wire:model="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlFile1">Product Image</label>
        <span class="d-block my-4">
                    @if( $product->image == null )
                <span>Image not available</span>
            @else
                <img src="{{asset('storage/'.$product->image)}}" width="200" height="150" alt="">
            @endif
                    <input type="hidden" wire:model="old_image">
                </span>
        <input type="file" class="form-control-file" wire:model="image" id="exampleFormControlFile1">
    </div>

    <div class="form-group">
        <button wire:click.prevent="update()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Update</button>
        <button wire:click.prevent="cancel()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Cancel</button>
    </div>

</form>