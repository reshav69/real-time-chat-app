<div class="flex items-center justify-center">
    <form wire:submit.prevent="updateGroup" class="rounded-xl shadow p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800 dark:text-gray-100">Edit Group</h2>
        <hr class="mb-5">
        <div class="mb-4">
            <x-input class="w-full"
                type="text" 
                id="name" 
                wire:model="name" 
                name="name" 
                placeholder="My Group" 
                label="Name"
            />
            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">

            <label for="description" class="block text-gray-200 font-bold mb-3">
                Description</label>
            <textarea class="shadow appearance-none border border-gray-300 rounded py-2 px-3 leading-tight
                 focus:outline-none focus:shadow-outline text-white w-full" rows="5"
             id="description" wire:model="description" placeholder="This is a group about groups"></textarea>

            @error('description') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="type" class="block text-gray-200 text-sm font-bold mb-2">Type</label>
            <select wire:model="type" id="type" class="w-full border p-2 rounded border-gray-300">
                <option class="bg-indigo-800 text-white" value="">Select a type</option>
                <option class="bg-indigo-800 text-white" value="private">Private</option>
                <option class="bg-indigo-800 text-white" value="public">Public</option>
            </select>
            @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="newIcon" class="block text-gray-200 text-sm font-bold mb-2">
                Group Icon</label> 
        
            @if ($group->icon)
                <p class="text-gray-400 mb-2">Current Icon:</p>
                <img src="{{ asset('storage/' . $group->icon) }}" alt="{{ $group->name }} Icon" class="w-24 h-24 rounded-full mb-2">
                <button wire:click="removeIcon" type="button" class="text-red-500 text-sm">Remove Icon</button>
            @else
                 <p class="text-gray-400 mb-2">No icon uploaded.</p>
            @endif
        
            <input type="file" wire:model="newIcon" id="newIcon" class="w-full border p-2 rounded border-gray-300 text-gray-800">
            @error('newIcon') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror 
        </div>
        
        <input type="submit" name="submit" id="submit" value="Update"
        class="bg-blue-500 hover:bg-blue-700
         text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >

        <button wire:click="deleteGroup" type="button" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 transition">
            Delete Group</button>

    </form>
</div>
{{-- Inside your form --}}
