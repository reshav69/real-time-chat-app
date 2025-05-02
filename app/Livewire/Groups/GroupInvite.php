<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupInvite extends Component
{

    public Group $group;
    public $search;

    public $searchResults = [];
    public $selectedUser = null;

    public function mount(Group $group){

        $this->group = $group;
    }
    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            $memberIds = GroupMember::where('group_id', $this->group->id)
                ->pluck('user_id');

            $this->searchResults = User::where('username', 'like', '%' . $this->search . '%')
                ->where('id', '!=', Auth::id())
                ->whereNotIn('id', $memberIds)
                ->take(10)
                ->get();
        } else {
            $this->searchResults = [];
        }

        $this->selectedUser = null;
    }


    public function selectUser(User $user)
    {
        $this->selectedUser = $user;
        $this->search = $user->username;
        $this->searchResults = [];
    }
    public function sendInvitation(){

    }

    public function cancel()
    {
        $this->dispatch('cancelInvitation'); 
        
        $this->reset(['search', 'searchResults', 'selectedUser']);
    }

    public function render()
    {
        return view('livewire.groups.group-invite');
    }
}
