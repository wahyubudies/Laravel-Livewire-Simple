<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $newComment;
    public $comments;

    protected $rules = [
        'newComment' => 'required|max:255'
    ];    
    public function mount()
    {                
        $this->comments = $this->index();
    }
    public function render()
    {
        return view('livewire.comments');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function index()
    {
        $comments = Comment::latest()->get();
        return $comments;
    }
    public function addComment()
    {
        $this->validate();
        
        $data = new Comment;
        $data->body = $this->newComment;
        $data->user_id = 1;
        $data->save();

        $this->comments->prepend($data);        
        $this->reset('newComment');
    }
    public function remove($id)
    {
        $data = Comment::find($id);        
        $data->delete();
        $this->comments = $this->comments->except($id);        
    }    
}
