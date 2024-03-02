<div>
    @include('livewire.includes.store-todod-form')
    @include('livewire.includes.search-box')
    @if (session('error'))
        <div class="p-4 my-2 bg-orange-100 border-l-4 border-orange-500 xt-orange-700 my" role="alert">
            <p class="font-bold">Be Warned</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <div id="todos-list">
        @forelse ($todos as $todo)
            @include('livewire.includes.todo-card')
        @empty
            <span class="flex justify-center bg-red-200 rounded-md">No Result</span>
        @endforelse
        <div class="my-2">
            {{ $todos->links() }}
        </div>
    </div>
</div>
