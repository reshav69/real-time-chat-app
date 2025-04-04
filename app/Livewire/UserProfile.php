<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{

    public $user;
    public function mount($username){
        $this->user = User::where('username',$username)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.user-profile');
    }
}
