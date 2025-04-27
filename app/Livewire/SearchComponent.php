<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Group;

class SearchComponent extends Component
{
    public $search = '';
    public $users = [];
    public $groups = [];

    public function updatedSearch()
    {
        $search = trim($this->search);

        if ($search == '') {
            $this->users = [];
            $this->groups = [];
            return;
        }

        $this->users = User::where('username', 'like', "%{$search}%")
            ->limit(5)
            ->get();

        $this->groups = Group::where('name', 'like', "%{$search}%")
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.search-component');
    }
}
