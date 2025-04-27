<div class="flex items-center justify-center">

    <form wire:submit.prevent="create" class="rounded-xl shadow p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800 dark:text-gray-100">Create Group</h2>
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
            <label for="type" class="block text-gray-200 text-sm font-bold mb-2">
                Type</label>
            <select wire:model="type" id="type" class="w-full border p-2 rounded border-gray-300">
                <option class="bg-indigo-800" value="private">Private</option>
                <option class="bg-indigo-800" value="public">Public</option>

            </select>
            @error('tpye') <span style="color: red;">{{ $message }}</span> @enderror

        </div>

        <div class="mb-6">
            <x-input class="w-full bg-indigo-800 hover:bg-indigo-900"
                type="file" 
                id="icon" 
                wire:model="icon" 
                name="icon" 
                label="Choose Group Icon"
            />
            @error('icon') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        @if (session()->has('sucecess'))
            <div class="mb-4 text-sm text-red-600 dark:text-red-400 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-center">
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
            >
                Create
            </button>
        </div>
    </form>
</div>
