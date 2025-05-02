<?php

namespace App\Livewire\Groups;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupInvitationPage extends Component
{

    public $sentInvitations = [];
    public $receivedInvitations = [];
    public function mount()
    {
        $this->sentInvitations = Auth::user()->sentGroupInvitations()->with('group', 'invitedUser')->get();
        $this->receivedInvitations = Auth::user()->receivedGroupInvitations()->with('group', 'invitedByUser')->get();
    }

    // public function mount(){
    //     $this->sentInvitations = Auth::user()->sentGroupInvitations()->get();
    //     dd($this->sentInvitations);

    //     $this->receivedInvitations = Auth::user()->receivedGroupInvitations();

    // }

    public function render()
    {
        return view('livewire.groups.group-invitation-page');
    }
}
