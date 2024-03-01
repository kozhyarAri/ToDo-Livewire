<?php

namespace App\Livewire;

use App\Models\ToDo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ToDoList extends Component
{
    use WithPagination;

    #[Rule('required|min:2')]
    public $name;

    public $search;

    public function store(){
        $validated = $this->validateOnly('name');
        ToDo::create($validated);
        $this->reset('name');
        session()->flash('success','ToDo is Added');
    }
    public function delete(ToDo $todo){
        $todo->delete();
        session()->flash('danger','ToDo is Deleted');
    }
    public function toggle(ToDo $todo){
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function render()
    {
        return view('livewire.to-do-list',[
            'todos' => ToDo::latest()->where('name','like',"%{$this->search}%")->paginate(5)
        ]);
    }
}
