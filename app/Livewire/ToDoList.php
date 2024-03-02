<?php

namespace App\Livewire;

use App\Models\ToDo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ToDoList extends Component
{
    use WithPagination;
    use WithFileUploads;
    #[Rule('required|min:2')]
    public $name;

    public $search;

    public $editingTodoId;

    #[Rule('required|min:2')]
    public $editingTodoName;

    #[Rule('nullable|file')]
    public $image;


    public function store()
    {
        $validated = $this->validate([
            'name'=> 'required|min:2',
            'image' => 'nullable|file|max:22288'
        ]);
        if ($this->image) {
            $validated['image'] = $this->image->store('uploads','public');
        }
        ToDo::create($validated);
        $this->reset('name','image');
        $this->resetPage();
        session()->flash('success', 'ToDo is Added');
    }
    public function delete($todoId)
    {
        try {
            $todo = ToDo::findOrFail($todoId);
            if ($todo->image) {
                unlink('storage/'.$todo->image);
            }
            $todo->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'You can`t delete this ToDo!');
            return;
        }
        session()->flash('danger', 'ToDo is Deleted');
    }
    public function toggle($todoId)
    {
        try {
            $todo = ToDo::findOrFail($todoId);
            $todo->completed = !$todo->completed;
            $todo->save();
        } catch (\Throwable $th) {
            session()->flash('error', 'You can`t Check this ToDo!');
            return;
        }
    }

    public function edit($toDoId)
    {
        try {
            $this->editingTodoId = $toDoId;
            $this->editingTodoName = ToDo::findOrFail($toDoId)->name;
        } catch (\Throwable $th) {
            session()->flash('error', 'You can`t Edit this ToDo!');
            return;
        }
    }

    public function cancel()
    {
        $this->reset('editingTodoId', 'editingTodoName');
    }

    public function update()
    {
        try {
            $this->validateOnly('editingTodoName');
            ToDo::findOrFail($this->editingTodoId)->update([
                'name' => $this->editingTodoName
            ]);
            $this->cancel();
        } catch (\Throwable $th) {
            session()->flash('error', 'You can`t Update this ToDo!');
            return;
        }
    }
    public function render()
    {
        return view('livewire.to-do-list', [
            'todos' => ToDo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
