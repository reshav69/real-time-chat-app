<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $bio;
    public $profile_image;
    public $new_profile_image;

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;
        // $this->profile_image = $user->profile_image;

    }
    public function updateProfile()
    {
        $this->validate([
            'username' => 'required|string|min:3|max:50|unique:users,username,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:500',
            // 'new_profile_image' => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();

        // if ($this->new_profile_image) {
        //     // Store the new image
        //     $imagePath = $this->new_profile_image->store('profile_images', 'public');
        //     $user->profile_image = $imagePath;
        // }
        $user->username = $this->username;
        $user->email = $this->email;
        $user->bio = $this->bio;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        view()->share('title', 'Edit Profile');
        return view('livewire.user-edit');
    }
}
