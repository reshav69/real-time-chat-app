<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class GroupsList extends Component
{
    public $myGroups;
    public $joined_groups = [];
    public function mount(){
        $this->myGroups = Group::where('admin_id',Auth::id())->get();

        $this->joined_groups = Auth::user()->groups()->get();

    }
    public function render()
    {
        view()->share('title', 'Groups List');
        return view('livewire.groups.groups-list');
    }
}
