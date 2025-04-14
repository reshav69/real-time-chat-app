<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Dashboard extends Component
{   


    public $user;
    public function mount(){
        // $this->user = User::where('username',Auth::user)->firstOrFail();
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.auth.dashboard');
    }
}
