<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class GroupsList extends Component
{
    public $myGroups;
    public function mount(){
        $myGroups = Group::where('admin_id',Auth::id());

    }
    public function render()
    {
        return view('livewire.groups.groups-list');
    }
}
