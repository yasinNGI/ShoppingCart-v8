<form wire:submit.prevent="store">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" class="@error('title') is-invalid @enderror form-control-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Enter Title" wire:model.defer="title">
        @error('title')
            <span class="invalid-feedback d-block" role="alert">
                   <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label>Price:</label>
        <input type="text" class="@error('price') is-invalid @enderror form-control-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Enter Price" wire:model.defer="price">
        @error('price')  <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>

    <div class="form-group">
        <label>Description:</label>
        <textarea wire:model.defer="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" cols="30" rows="8"></textarea>
    </div>

    <div class="form-group">
        <label>Upload Image:</label>

            <div x-data="{ isUploading: false , progress: 0 }"
                 x-on:livewire-upload-start="isUploading = true"
                 x-on:livewire-upload-finish="isUploading = false"
                 x-on:livewire-upload-error="isUploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress"
            >

            <input type="file" class="form-control-file" wire:model="image">
            <div class="mt-3" wire:loading wire:target="image">Uploading...</div>
            <div x-show="isUploading" class="progress mt-3" style="height: 10px;">
                <div class="progress-bar progress-bar-striped" role="progressbar" x-bind:style="`width:${progress}%`" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" >Create</button>
    </div>
{{--    wire:click.prevent="store()"--}}
</form>