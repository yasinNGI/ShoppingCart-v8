<div>
    <div class="form-group">
        <label>Name:{{$title}}</label>
        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Enter Title" wire:model.defer="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label>Price:</label>
        <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Enter Price" wire:model.defer="price">
        @error('price') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label>Description:</label>
        <textarea wire:model.defer="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label>Upload Image:</label>
        <input type="file" class="form-control-file" wire:model.defer="image">
    </div>

    <div class="form-group">
        <button type="button" wire:click.prevent="store()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" >Create</button>
    </div>
</div>