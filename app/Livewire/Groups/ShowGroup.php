<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowGroup extends Component
{
    public Group $group;
    public $isMember;
    public $isAdmin = false;


    public function mount(Group $group){
        $this->group = $group->load('members.user');
        $this->checkMembership();

    }   

    public function checkMembership()
    {

        $groupMember = GroupMember::where('group_id', $this->group->id)
                                  ->where('user_id', Auth::id())
                                  ->first();

        $this->isMember = (bool) $groupMember;


        if (Auth::id() === $this->group->admin_id) {
            $this->isAdmin = true;
        }
    }

    public function joinGroup(){
        if ($this->group->type !== 'public') {
            session()->flash('error', 'You cannot join this group.');
            return;
        }

        if ($this->isMember) {
            session()->flash('error', 'You are already a member of this group.');
            return;
        }
        $role = $this->isAdmin?"admin":'member';
        $newmember = GroupMember::create([
            'group_id' => $this->group->id,
            'user_id' => Auth::id(),
            'role' => $role,
            'created_at' => now(),
        ]);

        if($newmember){
            $this->isMember = true;
            session()->flash('success', 'You have joined the group!');
        }

        session()->flash('error', 'Failed joining the group!');
    
    }

    public function leaveGroup()
    {
    // Ensure user is logged in and is a member
        if (!$this->isMember) {
            session()->flash('error', 'You are not a member of this group.');
            return;
        }

        if ($this->isAdmin) {
            $otherAdminsCount = GroupMember::where('group_id', $this->group->id)
                                        ->where('role', 'admin')
                                        ->where('user_id', '!=', Auth::id())
                                        ->count();

            if ($otherAdminsCount === 0) {
                session()->flash('error', 'You must assign a new admin before leaving the group.');
                return;
            }
        }


        GroupMember::where('group_id', $this->group->id)
                ->where('user_id', Auth::id())
                ->delete();


        $this->isMember = false;
        $this->isAdmin = false; 

        session()->flash('success', 'You have left the group.');


        // return r

    }
    public function render()
    {
        view()->share('title', "Group: {$this->group->name}");
        return view('livewire.groups.show-group');
    }
}
