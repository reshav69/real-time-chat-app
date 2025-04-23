<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchComponent extends Component
{

    public $search='';
    public function render()
    {

        $users  = User::where('username', 'like', '%'.$this->search.'%')->get();

        return view('livewire.search-component',['users'=>$users]);
    }
}
