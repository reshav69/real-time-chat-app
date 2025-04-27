<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Group;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CreateGroup extends Component
{
    use WithFileUploads;

    #[Validate('required|string|min:3|max:250')]
    public $name;

    #[Validate('nullable|string|max:1000')]
    public $description;

    #[Validate('required|in:public,private')]
    public $type;

    #[Validate('nullable|image|max:2048')]
    public $icon;

    public function create(){
        $this->validate();

        $iconPath = null;

        if ($this->icon) {
            // Store the image in the 'group-icons' folder on the 'public' disk
            $iconPath = $this->icon->store('group-icons', 'public');
        }
        $newgroup = Group::create([
            'name'=>$this->name,
            'description'=>$this->description,
            'type'=>$this->type,
            'icon' => $iconPath,
            'admin_id' => Auth::id(),
        ]);
        // dd($newgroup);
        $this->reset(['name', 'description', 'type', 'icon']);

        if(!$newgroup)
            return;
        
        session()->flash('success', 'Group created successfully!');

    }

    public function render()
    {
        view()->share('title', 'Create Group');
        return view('livewire.groups.create-group');
    }
}
