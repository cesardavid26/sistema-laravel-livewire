<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $open = true;
    
    public $title, $content;

    public $rules = [
        'title' => 'required',
        'content' => 'required'
    ];

   
    public function save(){

        $this -> validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content

        ]);
        $this->reset(['open', 'title', 'content']);

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se creo satisfactoriamente!');
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    
}
