<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Support\Facades\Auth; // Import Auth facade

class EditGroup extends Component
{
    use WithFileUploads; 

    public Group $group;

    // Add validation rules directly here using attributes
    #[Validate('required|string|min:3|max:50')]
    public $name;

    #[Validate('nullable|string|max:1000')] // Corrected: Removed extra comma
    public $description;

    #[Validate('required|in:public,private')]
    public $type;

    // Validation for the new icon upload
    #[Validate('nullable|image|max:2048')]
    public $newIcon; // Use a different property name for the new file upload

    public function mount(Group $group)
    {
        // dd($group->admin_id);
        if (Auth::id() !== $group->admin_id) {
            abort(403, 'Unauthorized action.');
        }

       
        $this->group = $group;
        $this->name = $group->name;
        $this->description = $group->description;
        $this->type = $group->type;
        // Note: We don't initialize a public property with the existing icon path.
        // We'll handle updating the 'icon' column when a *new* file is uploaded.
    }

    public function updateGroup()
    {

        $this->validate();


         if (Auth::id() !== $this->group->admin_id) {
            session()->flash('error', 'Unauthorized action.'); 
            return redirect()->route('groups.show', $this->group); 
        }


        if ($this->newIcon) {
            
            if ($this->group->icon) {
                Storage::disk('public')->delete($this->group->icon);
            }

            $iconPath = $this->newIcon->store('group-icons', 'public');

            $this->group->icon = $iconPath;
        }


        $this->group->name = $this->name;
        $this->group->description = $this->description;
        $this->group->type = $this->type;

        $this->group->save();

        session()->flash('success', 'Group updated successfully!');

        // return redirect()->route('groups.show', $this->group);
    }

    public function deleteGroup()
    {

        if (Auth::id() !== $this->group->admin_id) {
            session()->flash('error', 'Unauthorized action.'); 
            return redirect()->route('groups.show', $this->group);
        }

        if ($this->group->icon) {
             Storage::disk('public')->delete($this->group->icon);
        }

        $this->group->delete();

        session()->flash('success', 'Group deleted successfully!');
        return redirect()->route('groups.list'); 
    }


    // Optional: Method to remove the existing icon without uploading a new one
    public function removeIcon()
    {
        // Authorization check
        if (Auth::id() !== $this->group->admin_id) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        if ($this->group->icon) {
            Storage::disk('public')->delete($this->group->icon);
            $this->group->icon = null;
            $this->group->save();
            session()->flash('success', 'Group icon removed.');
        }
    }


    public function render()
    {
        view()->share('title', 'Edit Group');
        return view('livewire.groups.edit-group');
    }
}