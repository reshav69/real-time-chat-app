<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Login extends Component

{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if(Auth::attempt($credentials))
        {
            session()->flash('message', 'You have successfully logged in!');
 
            return redirect()->route('dashboard');
        }
        
        session()->flash('error', 'Invalid credentials!');
    }

    public function render()
    {
        view()->share('title', 'Login');
        return view('livewire.auth.login');
    }
}
