<?php

namespace App\Livewire;

use Livewire\Component;

class FriendList extends Component
{
    public $friends;
    public function mount(){
        $this->friends = auth()->user()->friends;
    }
    public function render()
    {
        return view('livewire.friend-list');
    }
}
