<div class="container py-6 mx-auto content">
    <div class="mx-auto">
        <div id="create-form" class="p-6 bg-white border-t-2 border-blue-500 rounded-md shadow hover:shadow-xl">
            <div class="flex justify-between">
                <h2 class="mb-5 text-lg font-semibold text-gray-800">Create New Todo</h2>
                @if ($image)
                    <img class="h-16 rounded-md" src="{{ $image->temporaryUrl() }}" alt="">
                @endif
            </div>
            <div>
                <form>
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                            Todo </label>
                        <input wire:model='name' type="text" id="name" placeholder="Todo.."
                            class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                        @error('name')
                            <span class="block mt-3 text-xs text-red-500 ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                            Todo Image </label>
                        <input wire:model='image' type="file" accept="image/png , image/jpg , image/jpeg"
                            id="image" placeholder="Todo.."
                            class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                        @error('image')
                            <span class="block mt-3 text-xs text-red-500 ">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" wire:loading.attr='disabled' wire:click.prevent='store'
                        class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">Create
                        +</button>
                    <div wire:loading wire:target='image' class="mb-2 text-yellow-500 animate-bounce">
                        Image Uploading..
                    </div>
                    <div wire:loading wire:target='store' class="mb-2">
                        <img class="h-6 animate-spin" src="https://www.svgrepo.com/show/448500/loading.svg" alt="">
                    </div>
                    @if (session('success'))
                        <span class="text-xs text-green-500">{{ session('success') }}</span>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
