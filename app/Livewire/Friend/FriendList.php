<?php

namespace App\Livewire\Friend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FriendList extends Component
{
    public $friends;
    public function mount(){
        $this->friends = Auth::user()->friends;
    }
    public function render()
    {
        return view('livewire.friend.friend-list');
    }
}
