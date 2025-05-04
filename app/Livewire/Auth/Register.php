<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class Register extends Component
{

    #[Validate('required|string|min:3|max:250|alpha_dash')]
    public $username;

    #[Validate('required|email|max:250|unique:users,email')]
    public $email;

    #[Validate('required|string|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    public function register(){

        $this->validate();
        User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        session()->flash('message', 'You have successfully registered');

        return redirect()->route('login');
    }

    public function render()
    {
        view()->share('title', 'Register');
        return view('livewire.auth.register');
    }

}
