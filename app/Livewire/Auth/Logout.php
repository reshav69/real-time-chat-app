<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Logout extends Component
{
    public function logout()
    {
        Auth::logout();

        return $this->redirectRoute('login', navigate: true);
    }
    
    public function render()
    {
        return view('livewire.auth.logout');
    }

}
