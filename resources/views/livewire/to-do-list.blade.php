<div>
    @include('livewire.includes.store-todod-form')
    @include('livewire.includes.search-box')
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
